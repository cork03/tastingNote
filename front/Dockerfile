FROM node:22.12.0-alpine3.21

RUN apk update \
    && apk upgrade \
    && apk add --no-cache bash

WORKDIR /app

CMD ["npm", "run", "dev"]