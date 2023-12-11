# Serves for filtering movies.
#### Version 1.0b
#### Author: Vitalii Minenko

A simple application showing movies by 3 different filters.

##### Requriments
* Docker
* WSL 2.0
* PowerShell
* IDE
* Postman
##### Haw to start.
* For start application you should install docker and set WSL engine.
* Clone application into the folder with docker.
* Copy .env.example to .env at main folder.
* Open your project with command-line shell application for example PowerShell and do next command.
```
make up
```
By default, your application will be use http://localhost or http://0.0.0.0

* Now application is ready, and you can use it and test it by web version using SPA by Vue or use Rest API endpoints for example by Postman. Please enjoy ;)

##### Endpoints for filtering movies.
```
http://localhost/api/v1/movies?action=getByMoreThenOneWord
```
```
http://localhost/api/v1/movies?action=getByLetterAndPair
```
```
http://localhost/api/v1/movies?action=getByMoreThenOneWord
```
##### Haw to test application
* Type the following command in the command line:
```
make unit
```
