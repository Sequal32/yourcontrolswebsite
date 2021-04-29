import "reflect-metadata";
import { registerMiscellaneousController } from "./controllers";
import { HttpServer, TypeORM } from "./utils"

async function run() {
    const typeorm = new TypeORM();
    await typeorm.setup()
    const httpserver = new HttpServer();
    httpserver.addTypeORMConnection(typeorm)
    httpserver.startServer()
    registerMiscellaneousController(httpserver)
}

run()