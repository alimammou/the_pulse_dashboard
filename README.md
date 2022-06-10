# IoT Platform


## Local Development


#### Requirements

- composer
- php
- docker

#### Stack

- Laravel: Best PHP framework for web
- PHP
- MySQL
- Laravel Sail: for local development using docker and docker compose 
- NPM
- Tools: such as phpcsfix, grumphp, and more

#### Main Packages

- JetStream
- Debug Bar
- Log Viewer
- Spatie Media Library
- Livewire
- VueJs

#### Installation & First Time Running Locally

1. Clone the project
2. Run the following script
```bash
cp .env.example .env
composer install --ignore-platform-reqs
./vendor/bin/sail up -d
./vendor/bin/sail artisan migrate:fresh --seed
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
```

Now you can visit http://localhost and use the following credentials


#### Local Credentials

| Role          | Email           | Password  |
| ------------- |:---------------:| -----:|
| Admin         | admin@admin.com | 1234 |


#### Daily Running

Run the following script
```bash
./vendor/bin/sail up -d
./vendor/bin/sail npm run watch # just needed when modifying some assets such as css and js
```


## Deployment

We will be using gitlab CI/CD service.


## Production

Most likely we will be using:

- Terraform
- AWS Elastic Beanstalk
- AWS RDS
- AWS S3
- AWS CloudFront
