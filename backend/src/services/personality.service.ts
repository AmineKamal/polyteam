import * as ST from "simple-structures";
import { isString } from "simple-structures";
import { IResponse, validResponse } from "./types";

type EIAnswer = "e" | "i";
type JPAnswer = "j" | "p";
type SNAnswer = "s" | "n";
type TFAnswer = "t" | "f";

export interface Answers {
  ei: EIAnswer[];
  jp: JPAnswer[];
  sn: SNAnswer[];
  tf: TFAnswer[];
}

export const Personalities = [
  "ES",
  "IS",
  "EN",
  "IN",
  "ET",
  "IT",
  "EF",
  "IF",
] as const;

export type PersonalityType = typeof Personalities[number];
export type Personality = Partial<ST.StrictMap<PersonalityType, number>>;

export class PersonalityService {
  public static getPersonality(answers: Answers): IResponse<Personality> {
    console.log(answers);

    const personality: Personality = {};

    const EI = this.sum(answers.ei, "e");
    const JP = this.sum(answers.jp, "j");
    const SN = this.sum(answers.sn, "s");
    const TF = this.sum(answers.tf, "t");

    console.log(EI, JP, SN, TF);

    this.setPersonality(EI - JP + 2 * SN, personality, "ES", "IN");
    this.setPersonality(EI - JP - 2 * SN, personality, "EN", "IS");
    this.setPersonality(EI + JP + 2 * TF, personality, "ET", "IF");
    this.setPersonality(EI + JP - 2 * TF, personality, "EF", "IT");

    return validResponse(personality);
  }

  public static parsePersonality(str: string): Personality {
    if (!isString(str)) return {};

    try {
      const json = JSON.parse(str);
      if (!json.personality || typeof json.personality !== "object") return {};
      return json.personality;
    } catch (e) {
      return {};
    }
  }

  private static sum<P extends string, N extends string>(a: (P | N)[], pos: P) {
    let s = 0;
    a.forEach(e => (e === pos ? s++ : s--));
    return s;
  }

  private static setPersonality(
    v: number,
    p: Personality,
    upper: keyof Personality,
    bottom: keyof Personality
  ) {
    if (v < 0) {
      p[bottom] = Math.abs(v);
      p[upper] = undefined;
    } else if (v === 0) {
      p[bottom] = 0;
      p[upper] = 0;
    } else {
      p[upper] = undefined;
      p[upper] = v;
    }
  }
}
