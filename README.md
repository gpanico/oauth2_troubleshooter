# OAUTH2 Troubleshooter

### when you want to have a look at access_token, id_token, etc. 

Insert the secret parameters in dev.inc. 
Build the Docker container from the Dockerfile, and ship it to ECS Fargate.
Then run the get_code.php script from a WSL console, using the containers' URL as redirect URL. 

Et voila'. 


