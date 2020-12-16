import {
  Personality,
  PersonalityType,
  Personalities,
  PersonalityService,
} from "./personality.service";
import * as ST from "simple-structures";
import { shuffle, flatten } from "lodash";
import { errorResponse, ErrorService } from "./error.service";
import { validResponse } from "./types";

// tslint:disable-next-line:no-require-imports
const { convertArrayToCSV } = require("convert-array-to-csv");

export interface GroupingInstance {
  id: string;
  courseid: string;
  name: string;
  idnumber: string;
  description: string;
  descriptionformat: string;
  configdata?: any;
  timecreated: string;
  timemodified: string;
}

export interface Student {
  username: string;
  firstname: string;
  lastname: string;
  email: string;
  profile_field_polyteam: string;
}

export interface Grouping {
  id: string;
  grouping: GroupingInstance;
  members: Student[];
}

export interface TeamParams {
  teamSize: Range;
  teamSizePreference: "min" | "max";
  sections: string[];
  groupingName: string;
  prefix: string;
  algorithm: string;
  groupings: Grouping[];
  groupnames: string[];
}

export interface PersonalityStudent extends Student {
  personality: Personality;
}

interface Range {
  min: number;
  max: number;
}

type TeamSizePreference = "min" | "max";

type GroupMod = "reg" | "mar";

type AffinityGroupsPoints = ST.StrictMap<PersonalityType, [number, number][]>;

type AffinityGroups = ST.StrictMap<PersonalityType, [number, GroupMod][]>;

type Multiplicity = {
  i: number;
  reg: PersonalityType[];
  mar: PersonalityType[];
};

interface Team {
  students: Student[];
  score: number;
}

export class TeamService {
  public static generate(params: TeamParams) {
    const validatePrefix = this.validatePrefix(params);
    const teams = this.createTeams(params);

    if (!teams || !Array.isArray(teams) || !teams.every(Boolean))
      return errorResponse("invalid-team-size-range", "ERROR", "team_size", null, [
        "max",
        "min",
      ]);

    const usernames = teams.map(t => t.students.map(s => s.username));
    const { prefix } = params;
    const teamUsernames = usernames.map((u, i) => u.map(e => [e, prefix + i]));

    const csv: string = convertArrayToCSV(flatten(teamUsernames));

    if (!validatePrefix) return errorResponse("invalid-prefix", "WARNING", "prefix", {csv, teams});

    return validResponse({csv, teams});
  }

  private static validatePrefix(params: TeamParams) {
    const { groupnames, prefix } = params;

    if (groupnames.some(g => g.startsWith(prefix))) return false;

    return true;
  }

  private static createTeams(params: TeamParams) {
    const {
      sections,
      groupings,
      algorithm,
      teamSize,
      teamSizePreference,
    } = params;

    let groups = groupings.filter(({ grouping }) => sections.includes(grouping.name) || sections.includes("All")).map(g => g.members);

    const combine = false;

    if (combine) {
      groups = [flatten(groups)];
    }

    return flatten(groups.map((members) => {
      switch (algorithm) {
        case "MBTI":
          const personalityStudents = members.map(m => ({
            ...m,
            personality: PersonalityService.parsePersonality(
              m.profile_field_polyteam
            ),
          }));

          return this.createAffinityGroupsTeams(
            personalityStudents,
            teamSize,
            teamSizePreference
          );

        case "RANDOM":
          return this.createRandomTeams(members, teamSize, teamSizePreference);

        default:
          return;
      }
    }));
  }

  private static createRandomTeams(
    students: Student[],
    size: Range,
    preference: TeamSizePreference = "min"
  ) {
    const teamFormat = this.getTeams(students.length, size, preference);
    if (!teamFormat) return null;

    const teams: Student[][] = teamFormat.map(t => []);
    const members = shuffle(students);

    let pos = 0;
    members.forEach(m =>
      teams[teams[pos].length < teamFormat[pos] ? pos : ++pos].push(m)
    );

    const finalTeams: Team[] = teams.map(t => ({ students: t, score: 0 }));
    return finalTeams;
  }

  private static createAffinityGroupsTeams(
    students: PersonalityStudent[],
    size: Range,
    preference: TeamSizePreference = "min"
  ) {
    // STEP 1: We get the teams number based on the range given
    const teamFormat = this.getTeams(students.length, size, preference);
    if (!teamFormat) return null;

    const teamLen = teamFormat.length;

    // STEP 2: Setup Affinity groups
    const affPoints: AffinityGroupsPoints = ST.initStrict(Personalities, []);

    // We map and sort all the different personalities for all the students
    const wpoints = ST.owrap(affPoints);
    wpoints.forEach((v, k) =>
      v.push(
        ...students
          .map((s, i) => ST.tuple(i, s.personality[k]))
          .filter(t => t[1])
      )
    );

    wpoints.forEach(v => ST.sortWithkey(v, 1, ST.desc));

    const affGroups: AffinityGroups = ST.mapStrict(affPoints, o =>
      this.getGroupMode(teamLen, o)
    );

    const ranking: Multiplicity[] = students.map((_, i) => ({
      i,
      reg: [],
      mar: [],
    }));

    const wgroups = ST.owrap(affGroups);
    wgroups.forEach((v, k) => v.forEach(([i, mod]) => ranking[i][mod].push(k)));

    ranking.sort((a, b) => {
      const aReg = a.reg.length;
      const aMar = a.mar.length;
      const bReg = b.reg.length;
      const bMar = b.mar.length;

      if (bReg > aReg || (bReg === aReg && bMar > aMar)) return 1;
      if (aReg > bReg || (aReg === bReg && aMar > bMar)) return -1;
      if (aReg === bReg && aMar === bMar)
        return students[a.i].lastname > students[b.i].lastname ? 1 : -1;

      return 0;
    });

    const seeds = ranking.splice(0, teamLen);
    const teams = seeds.map(s => new MultiplicityTeam(s));

    if (ranking.length >= teamLen) {
      const dyads = ranking.splice(0, teamLen);
      const available = teams.map((t, i) => t.len < teamFormat[i]);

      dyads.forEach(d => {
        const score = available.map((a, i) => (a ? teams[i].score(d) : -1));
        const pos = score.indexOf(Math.max(...score));
        teams[pos].addCore(d);
        available[pos] = false;
      });
    }

    const remainder = shuffle(ranking);
    const places = teams.map((t, i) => teamFormat[i] - t.len);

    remainder.forEach(d => {
      const score = places.map((p, i) => (p > 0 ? teams[i].score(d) : -1));
      const pos = score.indexOf(Math.max(...score));
      teams[pos].addExternal(d);
      places[pos]--;
    });

    const finalTeams: Team[] = teams.map(t => {
      return {
        students: t.students.map(s => students[s.i]),
        score: (t.mods.length / Math.max(t.students.length, 8)) * 100
      };
    });

    return finalTeams;
  }

  private static getTeams(
    len: number,
    size: Range,
    preference: TeamSizePreference
  ) {
    if (size.min === NaN || size.max === NaN) return null;
    if (size.min <= 0 || size.max <= 0) return null;
    if (size.max < size.min) return null;
    if (len < size.min) return null;

    if (preference === "min") return this.getMinTeams(len, size);
    else return this.getMaxTeams(len, size);
  }

  private static getMinTeams(len: number, size: Range) {
    const { min, max } = size;

    for (let i = min; i <= max; i++) {
      if (len % i === 0) return new Array<number>(len / i).fill(i);
    }

    let modMin = len % min;
    const teamsMin = (len - modMin) / min;
    const diff = max - min;

    // Impossible to create teams given the length and the range
    if (teamsMin + diff <= modMin) return null;

    const teams = new Array<number>(teamsMin).fill(min);
    for (let i = 0; modMin > 0; modMin--) {
      teams[i]++;
      i = (i + 1) % teamsMin;
    }

    return teams;
  }

  private static getMaxTeams(len: number, size: Range) {
    const { min, max } = size;

    for (let i = max; i >= min; i--) {
      if (len % i === 0) return new Array<number>(len / i).fill(i);
    }

    let modMax!: number;
    let teamsMax!: number;
    let diff: number;
    let passed = false;
    let current = max - 1;

    for (; current >= min; current--) {
      modMax = len % current;
      teamsMax = (len - modMax) / current;
      diff = max - current;
      if (teamsMax + diff > modMax) {
        passed = true;
        break;
      }
    }

    // Impossible to create teams given the length and the range
    if (!passed) return null;

    const teams = new Array<number>(teamsMax).fill(current);
    for (let i = 0; modMax > 0; modMax--) {
      teams[i]++;
      i = (i + 1) % teamsMax;
    }

    return teams;
  }

  private static getGroupMode(
    teamLen: number,
    affPoints: [number, number][]
  ): [number, GroupMod][] {
    const mods = affPoints.map(([i]) => ST.tuple(i, "reg" as GroupMod));

    for (let i = mods.length - 1; i >= 0; i--) {
      if (i === 0) {
        if (
          mods.length > 1 &&
          affPoints[i][1] === affPoints[i + 1][1] &&
          mods[i + 1][1] === "mar"
        ) {
          mods[i][1] = "mar";
        }
        continue;
      }

      if (affPoints[i][1] < affPoints[i - 1][1] && i >= teamLen) {
        mods.splice(i);
        continue;
      }

      if (affPoints[i][1] === affPoints[i - 1][1] && i >= teamLen) {
        mods[i][1] = "mar";
        continue;
      }

      if (
        mods.length > i + 1 &&
        affPoints[i][1] === affPoints[i + 1][1] &&
        mods[i + 1][1] === "mar"
      ) {
        mods[i][1] = "mar";
      }
    }

    return mods;
  }
}

class MultiplicityTeam {
  core: Multiplicity[] = [];
  external: Multiplicity[] = [];
  changed = true;
  len = 1;
  private _mods: PersonalityType[];
  private _external: Multiplicity[];

  public constructor(seed: Multiplicity) {
    this.core.push(seed);
  }

  public get mods() {
    if (!this.changed) return this._mods;
    this.changed = false;
    this._mods = this.calculateMods([...this.core, ...this.external]);

    return this._mods;
  }

  public score(student: Multiplicity) {
    const mods = this.mods;
    const mlen = mods.length;
    const wmods = ST.awrap(mods);

    const { reg, mar } = student;
    wmods.uniquePush([...reg, ...mar]);

    return mods.length - mlen;
  }

  public addCore(student: Multiplicity) {
    this.core.push(student);
    this.changed = true;
    this.len++;
  }

  public addExternal(student: Multiplicity) {
    this.external.push(student);
    this.changed = true;
    this.len++;
  }

  public get students() {
    return [...this.core, ...this.external];
  }

  public resetExternal() {
    this.len -= this.external.length;
    this._external = new Array(...this.external);
    this.external = [];
    this.changed = true;
  }

  private calculateMods(mul: Multiplicity[]) {
    const mods = [] as PersonalityType[];
    const wmods = ST.awrap(mods);
    mul.forEach(({ reg, mar }) => wmods.uniquePush([...reg, ...mar]));

    return mods;
  }
}

// function test() {
//   const students: Partial<Student>[] = [
//     {
//       lname: "A",
//       username: "",
//       personality: { ES: 4, IS: 8, EF: 2, IF: 2 },
//     },
//     {
//       lname: "B",
//       username: "",
//       personality: { IS: 0, EN: 0, IN: 2, ET: 1, EF: 1 },
//     },
//     {
//       lname: "C",
//       username: "",
//       personality: { ES: 1, IS: 3, IT: 4, IF: 2 },
//     },
//     {
//       lname: "D",
//       username: "",
//       personality: { ES: 3, IS: 9, EF: 6 },
//     },
//     {
//       lname: "E",
//       username: "",
//       personality: { ES: 3, IS: 7, ET: 2, IT: 2, IF: 3 },
//     },
//     {
//       lname: "F",
//       username: "",
//       personality: { EN: 7, IN: 3, EF: 1 },
//     },
//     {
//       lname: "G",
//       username: "",
//       personality: { ES: 1, EN: 3, ET: 1, IT: 1, IF: 2 },
//     },
//     {
//       lname: "H",
//       username: "",
//       personality: { IS: 3, IN: 1, IT: 6, IF: 0 },
//     },
//     {
//       lname: "I",
//       username: "",
//       personality: { ES: 5, EN: 1, ET: 0, EF: 2 },
//     },
//     {
//       lname: "J",
//       username: "",
//       personality: { ES: 0, IS: 0, EN: 0, IN: 0, ET: 2, EF: 6 },
//     },
//     // {
//     //   lname: "K",
//     //   username: "",
//     //   personality: { ES: 4, IS: 8, EF: 2, IF: 2 },
//     // },
//     // {
//     //   lname: "L",
//     //   username: "",
//     //   personality: { ES: 4, IS: 8, EF: 2, IF: 2 },
//     // },
//     // {
//     //   lname: "M",
//     //   username: "",
//     //   personality: { ES: 4, IS: 8, EF: 2, IF: 2 },
//     // },
//     // {
//     //   lname: "N",
//     //   username: "",
//     //   personality: { ES: 4, IS: 8, EF: 2, IF: 2 },
//     // },
//     // {
//     //   lname: "O",
//     //   username: "",
//     //   personality: { ES: 4, IS: 8, EF: 2, IF: 2 },
//     // },
//     // {
//     //   lname: "P",
//     //   username: "",
//     //   personality: { ES: 4, IS: 8, EF: 2, IF: 2 },
//     // },
//     // {
//     //   lname: "Q",
//     //   username: "",
//     //   personality: { ES: 4, IS: 8, EF: 2, IF: 2 },
//     // },
//     // {
//     //   lname: "R",
//     //   username: "",
//     //   personality: { ES: 4, IS: 8, EF: 2, IF: 2 },
//     // },
//     // {
//     //   lname: "S",
//     //   username: "",
//     //   personality: { ES: 4, IS: 8, EF: 2, IF: 2 },
//     // },
//     // {
//     //   lname: "T",
//     //   username: "",
//     //   personality: { ES: 4, IS: 8, EF: 2, IF: 2 },
//     // },
//     // {
//     //   lname: "U",
//     //   username: "",
//     //   personality: { ES: 4, IS: 8, EF: 2, IF: 2 },
//     // },
//   ];
//   const size: Range = { min: 3, max: 4 };

//   // const t = TeamService.createAffinityGroupsTeams(students, size);
//   // console.log(t);
// }

// test();
