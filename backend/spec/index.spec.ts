import * as sinon from "sinon";
import { expect, assert } from "chai";
import * as mocks from "node-mocks-http";
import { indexController } from "../src/controllers/index.controller";

describe("Index Controller", function() {
  let res: mocks.MockResponse<any>;

  beforeEach(() => {
    res = mocks.createResponse();
  });

  it("Can render the index page", async function() {
    let req, spy;
    spy = res.render = sinon.spy();
    indexController.index(req, res, null);
    expect(spy.calledOnce).to.equal(true);
  });
});
