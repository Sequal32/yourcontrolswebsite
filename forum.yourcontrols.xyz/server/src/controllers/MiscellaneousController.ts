import * as express from "express";

export default class UserController {
    index() {
        return async (req: express.Request, res: express.Response) => {
            res.json({
                message: "Hello",
            })
        }
    }
}