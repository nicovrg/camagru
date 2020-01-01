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
