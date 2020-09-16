# Laravel + Vuejs Dockerized
- This Project is built with **Docker**, **Laravel** & **Vuejs** (with **BootStrap**) to visualize csv by **Plotly** subplots with shared axes(x-axes here).

## Installation:

- ```docker-compose up -d --build```
- ```docker-compose run --rm composer install```
- ```docker-compose run --rm npm install```
- Now create .env file and replace DB_HOST & REDIS_HOST with ```DB_HOST=mariadb & REDIS_HOST=redis```  
 **OR** 
- Just Rename /src/env.sample as .env file (If you just want to explore project)
- ```docker-compose run --rm artisan migrate```

## Useage:

- Development:
    - ```docker-compose run --rm npm run watch-poll``` 
    - OR 
    - ```docker-compose run --rm npm run dev```
- Production:
    - ```docker-compose run --rm npm run prod```

## Notes:
- Csv file must contain column named "Time".

## Screenshots:

![Plots](docs/images/screenshot.png?raw=true "Plots")
