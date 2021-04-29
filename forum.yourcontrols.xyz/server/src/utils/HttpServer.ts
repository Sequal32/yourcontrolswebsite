import * as express from "express";
import { TypeORM } from ".";


export default class HttpServer {

    app: express.Express
    typeorm: TypeORM

    constructor() {
        this.app = express()
    }

    addGetController(url: string,conntroller: express.RequestHandler) {
        this.app.get(url, conntroller)
    }

    addPostController(url: string,conntroller: express.RequestHandler) {
        this.app.post(url, conntroller)
    }

    addDeleteController(url: string,conntroller: express.RequestHandler) {
        this.app.delete(url, conntroller)
    }

    addPatchController(url: string,conntroller: express.RequestHandler) {
        this.app.patch(url, conntroller)
    }

    addTypeORMConnection( typeorm: TypeORM ) {
        this.typeorm = typeorm
    }

    startServer() {
        const port = 8080
        this.app.listen(port, () => {
            console.log(`[HTTP] Listening on http://127.0.0.1:${port}/`)
        })
    }
}