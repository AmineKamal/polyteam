import { Request, Response } from "express";
import { shuffle, chunk, flatten } from "lodash";
import { Answers, PersonalityService } from "../services/personality.service";
import { Student, TeamParams, TeamService } from "../services/team.service";

export default class IndexController {
  public index(req: Request, res: Response, next: Function): void {
    res.render("index", { title: "Projet 4" });
  }

  public getPersonality(req: Request, res: Response) {
    res.json(PersonalityService.getPersonality(req.body as Answers));
  }

  public createTeams(req: Request, res: Response) {
    const params = req.body as TeamParams;
    const csv = TeamService.generate(params);

    if (!csv) res.sendStatus(400);
    else res.json(csv);
  }
}

export const indexController = new IndexController();
