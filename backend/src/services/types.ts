export interface IResponse<T> {
  status: boolean;
  data: T;
}

export interface IValidResponse<T> extends IResponse<T> {
  status: true;
}

export function validResponse<T>(data: T): IValidResponse<T> {
  return {
    status: true,
    data,
  };
}
