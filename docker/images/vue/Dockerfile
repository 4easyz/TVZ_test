FROM node:latest

COPY ./project/basic/vue_app /var/www/html/basic/vue_app/

WORKDIR /var/www/html/basic/vue_app

RUN npm install -g @vue/cli
RUN npm install

EXPOSE 8080

CMD ["npm", "run", "serve"]
