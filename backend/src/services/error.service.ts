import { IResponse } from "./types";

type ErrorCode = "invalid-team-size-range";
type ErrorInput = "team_size" | "team_size_preference";
type ErrorInputSuffix = "" | "min" | "max";

export interface IError {
  code: ErrorCode;
  input?: ErrorInput;
  suffixes: ErrorInputSuffix[];
}

export interface IErrorResponse extends IResponse<IError> {
  status: false;
}

export class ErrorService {
  static get(
    code: ErrorCode,
    input?: ErrorInput,
    suffixes: ErrorInputSuffix[] = [""]
  ): IErrorResponse {
    return {
      status: false,
      data: {
        code,
        input,
        suffixes,
      },
    };
  }
}

export function errorResponse(
  code: ErrorCode,
  input?: ErrorInput,
  suffixes: ErrorInputSuffix[] = [""]
) {
  return ErrorService.get(code, input, suffixes);
}
