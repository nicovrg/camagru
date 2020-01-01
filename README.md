# Camagru

## Introduction

Camagru is the first project of 42 web project branch. You're asked to make a copycat from instagram.
The subject impose html/css/js for the frontend and php for the backend. No frameworks are allowed.
Despite this, ajax/jquery are allowed.

I choose to use docker to host services i needed for the deployment and developement:
	- web server: apache 5.6
	- database: mysql 5.7 and phpmyadmin
	- mail server: used an image from github and the domain of my friend guillaumerx

You can find the subject in the pdf directory.


On the homepage, you can see all pictures that have been taken.
User can register, need to validate their account through the link sent by email.
Once login, they will be able to like and comment pictures, and access to the camera page.
They can also edit their account, renew their password (with mail token), delete their account.

Then on the gallery page, user can upload a picture from either their local storage or the webcam.
They can add a filter on top of it and take a picture.
The picture is then added to the homepage where it can be liked an comment by other users.

## Setup:

if not already install, please do:

- brew install docker
- brew install docker-machine
- brew install docker-compose

then your can do:
- docker-machine create --driver=virtualbox server
- eval $(docker-machine env server)
- docker-compose up

### Notes:

docker-machine create --driver=virtualbox server:
	docker-Machine create a virtual linux machine to run the daemon (process) docker engine using virtualbox
	it's native on linux but not on mac os so we need to virtualise the daemon
	then we have a docker machine name server that run in background

eval $(docker-machine env server):
	docker-machine env server will return the different variables to export in shell to connect to the server (a docker machine)
	eval will take the return of these commands and run them

docker-compose up:
	this command will take the docker-compose.yml file and execute the instructions in it
	in our case it will pull lavoweb, mysql and myadmin images from the dockerhub
	then it will build these images and run them in three different containers
