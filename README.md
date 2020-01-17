## Introduction
This project let you know what vars and constants are used by clients, with a frontend search engine.
This project provides a docker set up. Using docker is not mandatory but it's better to have consistencies between developers. It makes the project usable really fast. <br><br>
If : <br>
- *you don't use docker*, you must install php 7.2+, node and nginx.
- *you use docker*, you have to install docker and docker-compose. You can find the install documentation here :
    - docker : https://docs.docker.com/install/
    - docker-compose : https://docs.docker.com/compose/install/


## Installation
Don't hesitate to read `Makefile` as it contains all the useful commands. To display help, please type `make help`

Just clone the repo, then follow thoses steps :
- `cd larabuild && make install`
- at the end of .env file, change the `FULLCORE_PATH=~/fullCore` to the fullCore path on your machine
- `make dev`
- You can now access the project on 12.0.0.1:8000/vars

## Use
For the moment, you can :
- `GET /vars` to display a variables searchable list
- `GET /constants` to display a constant searchable list
- `GET /api/application-reader` to have a json response containing information.
<br><br>Note that this project contains unit tests.
