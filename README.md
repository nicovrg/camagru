# Camagru



## todo list:

## setup:

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



## docker-compose.yml:
version: '2'

services:
	web:
		image: lavoweb/php-5.6
		ports:
			- "80:80"
		volumes:
			- ./camagru/:/var/www/html
		links:
			- db:db
	db:
		image: mysql:5.7
		ports:
			- "3306:3306"
		environment:
			- MYSQL_USER=camagru
			- MYSQL_ROOT_PASSWORD=root42
			- MYSQL_DATABASE=camagru
			- MYSQL_PASSWORD=camagru42
	myadmin:
		image: phpmyadmin/phpmyadmin
		ports:
			- "8080:80"
		links:
			- db:db