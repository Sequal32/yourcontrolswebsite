import { createConnection, Connection } from "typeorm";
import { appendFile } from 'fs';

export default class TypeORM {
    private connection: Connection
    async setup() {
        await createConnection().then(connection => {
            console.error(`[TYPEORM] Connection established with database`)
            this.connection = connection
        })
        .catch(reason => {
            console.error(`[TYPEORM ERROR] ${reason}`)
        })
    }
    getConnection() {
        return this.connection
    }

}
