import { Request, Response } from "express";
import { shuffle, chunk, flatten } from "lodash";
import { Answers, PersonalityService } from "../services/personality.service";
import { Student, TeamParams, TeamService } from "../services/team.service";

export default class IndexController {
  public index(req: Request, res: Response, next: Function): void {
    res.render("index", { title: "Projet 4" });
  }

  public getPersonality(req: Request, res: Response) {
    const response = PersonalityService.getPersonality(req.body as Answers);

    if (response.status) {
      res.json(response.data);
    } else {
      res.status(400).json(response.data);
    }
  }

  public createTeams(req: Request, res: Response) {
    const params = req.body as TeamParams;
    const response = TeamService.generate(params);

    if (response.status) {
      res.json(response.data);
    } else {
      res.status(400).json(response.data);
    }
  }
}

export const indexController = new IndexController();
