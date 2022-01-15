## About Project

Laravel,Bootstrap and Vuejs have been used in the project.
Laravel Sanctum REST API has been used in this project.

Please follow below steps after cloning the project from github!

1. Run `git clone 'link projet github'
2. Run composer install
3 -Run npm install
3. Run cp .env.example .env or copy .env.example .env
4. Add your own database detail in .env file
5. Run php artisan key:generate
6. Run php artisan migrate --seed
7. Run php artisan serve
8. Run npm run dev
9. Run npm run watch
10. Go to link localhost:8000 OR 127.0.0.1:8000

## For Testing PhpUnit

1. Go to .env.testing file and add a new testing db's details.
2. Run  php artisan test --filter JobTest --env=testing


## For Running App on docker

1. Run docker-compose -f docker_compose.yml build
2. Run docker-compose -f docker_compose.yml up -d
3. Migrate database from CLI

If you want to down your docker, please run below command

3. Run docker-compose -f docker_compose.yml down

