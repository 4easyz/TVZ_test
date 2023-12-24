FROM node:latest

COPY ./project/basic/vue_app /var/www/html/basic/vue_app/

WORKDIR /var/www/html/basic/vue_app

# RUN npm cache clean -f
RUN npm install -g @vue/cli
RUN npm install
# RUN export PATH=$PATH:/root/.npm-global/bin 
# RUN npm install --location=global @vue/cli
# RUN npm install
# ENV PATH /var/www/html/basic/vue_app/node_modules/.bin:$PATH
# COPY ./ .
EXPOSE 8080
# RUN npm run serve

CMD ["npm", "run", "serve"]
