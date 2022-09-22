FROM nginx:latest

ENV TZ=Europe/Moscow

RUN apt-get update
RUN apt-get install -y tzdata

RUN cp /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

WORKDIR /app
