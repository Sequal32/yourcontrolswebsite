import { HttpServer } from "../utils";
import MiscellaneousController from "./MiscellaneousController";


export function registerMiscellaneousController( httpServer: HttpServer ) {
    const miscellaneousController = new MiscellaneousController()

    httpServer.addGetController("/", miscellaneousController.index())
}