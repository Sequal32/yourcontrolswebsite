import { GraphQLServer } from 'graphql-yoga';
import * as TypeORM from 'typeorm';
import { buildSchema } from 'type-graphql';
import { ContextParameters } from 'graphql-yoga/dist/types';
import { Context } from './context';
import { User } from './entities';
import { customAuthChecker } from './auth-checker';
import authMiddleware from './middleware/auth-middleware';

async function createServer(connection: TypeORM.Connection) {
    try {
        const schema = await buildSchema({
            resolvers: [__dirname + '/resolvers/**/*.ts'],
            emitSchemaFile: true,
            authChecker: customAuthChecker
        });
        const server = new GraphQLServer({
            schema,
            context: async ({ request }: ContextParameters) => {
                let context: Context = {};
                if (request['userId']) {
                    context.user = await connection.manager.findOne(
                        User, {
                            where: {id: request['userId']},
                            relations: ['roles'],
                        });
                }
                return context;
            }
        });
        server.express.use(authMiddleware);

        return server;
    } catch (err) {
        console.log(err)
    }
}
export default createServer;
