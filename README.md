## About News App

News App fetch and stores articles from third party APIs and perform search operations on it.

## Prerequisites
- Git
- Docker compose

## Installation Steps

- Clone the Repo by this command: `git clone git@github.com:hirenwadhiya/laraveltest.git`
- Navigate to project directory by: `cd laraveltest`
- Create environment file from demo file: `cp .env.example .env`
- Create testing env file from demo file: `cp .env.example .env.testing`
- Signup on NewsAPI, The Guardian and New York Times and create API key and paste it in env file
- Run docker up command: `docker compose up`
- Install packages by: `docker exec -it php composer install`
- Set of commands: `docker exec -it php php composer setup`
Once it is successful, application is available at http://127.0.0.1:8080/

## API Endpoints

### Register a User
`curl --location 'http://127.0.0.1:8080/api/register' \
  --header 'Accept: application/json' \
  --form 'name="Adam Smith"' \
  --form 'email="adam@example.com"' \
  --form 'password="Password@123"'`

### Login
`curl --location 'http://127.0.0.1:8080/api/login' \
--header 'Accept: application/json' \
--form 'email="adam@example.com"' \
--form 'password="Password@123"'`

### Logout
`curl --location --request POST 'http://127.0.0.1:8080/api/logout' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer 2|BearerTokenPlainString3bjH6TQRT5oo9TcnAfTGTHvDa1526611'`

### Forget Password
`curl --location 'http://127.0.0.1:8080/api/password/email' \
--header 'Accept: application/json' \
--form 'email="adam@example.com"'`

### Reset Password
`curl --location 'http://127.0.0.1:8080/api/password/reset' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer 2|zN5qiIZWPBUTGpyA3bjH6TQRT5oo9TcnAfTGTHvDa1526635' \
--form 'email="adam@example.com"' \
--form 'token="\$2y\$12\$1LC2izZeeXQYftp9XWQ1Muc4FMXRdnkcM3LZENTAriXPzOpy7dHcG"' \
--form 'password="Smith@123"' \
--form 'password_confirmation="Smith@123"'`

### Article Search
`curl --location 'http://127.0.0.1:8080/api/articles' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer 2|zN5qiIZWPBUTGpyA3bjH6TQRT5oo9TcnAfTGTHvDa1526635'`

### Single Article
`curl --location 'http://127.0.0.1:8080/api/articles/290' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer 2|zN5qiIZWPBUTGpyA3bjH6TQRT5oo9TcnAfTGTHvDa1526635'`
