FROM node:8.11.1

RUN mkdir -p /usr/src/app
WORKDIR /usr/src/app

COPY package.json /usr/src/app/
RUN npm install

COPY . /usr/src/app
RUN ls -a
RUN (npm run build || true) > out.txt
RUN cat out.txt

EXPOSE 3000

CMD [ "npm", "run", "start" ]
