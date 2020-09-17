import { Server } from "http";
import * as socket from "socket.io";

export class Socket {
  public io: socket.Server;

  constructor(http: Server) {
    this.io = socket(http);
    this.connect();
  }

  public connect() {
    this.io.on("connection", (s: socket.Socket) => {
      console.log(`connected : ${s.id}`);
    });
  }

  public disconnectHandler(s: socket.Socket) {
    s.on("disconnect", () => {
      console.log(`Socket disconnected : ${s.id}`);
    });
  }
}
