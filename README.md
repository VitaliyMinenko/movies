# Movies service
#### Version 1.0b
#### Author: Vitalii Minenko

A simple application showing movies by 3 different filters.

##### Requirements
* Docker
* WSL 2.0
* PowerShell
* IDE
* Postman

##### How to start
* To start the application, you should install Docker and set up WSL engine.
* Clone the application into the folder with Docker.
* Copy .env.example to .env in the main folder.
* Open your project with a command-line shell application, for example, PowerShell, and execute the following command:
```
make up
```
By default, your application will use http://localhost or http://0.0.0.0

* Now, the application is ready, and you can use and test it by the web version using SPA by Vue or use Rest API endpoints, for example, by Postman. Please enjoy ;)

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
