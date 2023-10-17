
# Docker LAMP
Linux + Apache + MariaDB (MySQL) + PHP 7.2 on Docker Compose. Mod_rewrite enabled by default.

## Instructions

Clone the repository in your preferred folder.

```bash
$ cd SGSSI-Proyecto/
```

```bash
$ docker image rm web:latest
```

```bash
$ docker build -t="web" .
```

To start the container:
```bash
$ docker-compose up 
```
Then, import the database in localhost:8890/
After, go to localhost:81/

To stop the container:
```bash
Crtl + C or docker-compose down
```

Feel free to make pull requests and help to improve this.

If you are looking for phpMyAdmin, take a look at [this](https://github.com/celsocelante/docker-lamp/issues/2).

NOMBRES DE LOS INTEGRANTES

"Adrian Mena"
"Ander Gutierrez"
"Asier Cardoso"
"Aritz Blasco"
"Eneko Etxaniz"
"Jon Marcos"
