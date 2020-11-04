import { IResponse } from "./types";

type ErrorCode = "invalid-team-size-range" | "invalid-prefix" | "general";
type ErrorInput = "team_size" | "team_size_preference" | "prefix";
type ErrorInputSuffix = "" | "min" | "max";
type ErrorSeverity = "ERROR" | "WARNING";

export interface IError<T> {
  data?: T;
  severity: ErrorSeverity;
  code: ErrorCode;
  input?: ErrorInput;
  suffixes: ErrorInputSuffix[];
}

export interface IErrorResponse<T> extends IResponse<IError<T>> {
  status: false;
}

export class ErrorService {
  static get<T>(
    code: ErrorCode,
    severity: ErrorSeverity,
    input?: ErrorInput,
    data?: T,
    suffixes: ErrorInputSuffix[] = [""]
  ): IErrorResponse<T> {
    return {
      status: false,
      data: {
        severity,
        data,
        code,
        input,
        suffixes,
      },
    };
  }
}

export function errorResponse<T>(
  code: ErrorCode,
  severity: ErrorSeverity,
  input?: ErrorInput,
  data?: T,
  suffixes: ErrorInputSuffix[] = [""]
) {
  return ErrorService.get(code, severity, input, data, suffixes);
}
