import { Express } from "express";
import { indexController } from "../controllers/index.controller";

export default class Routes {
  constructor(app: Express) {
    app.route("/").get(indexController.index);
    app.route("/teams").post(indexController.createTeams);
    app.route("/personality").post(indexController.getPersonality);
  }
}
