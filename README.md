# BirdBoard
[![Build Status](https://travis-ci.org/dustinhsiao21/birdboard.svg?branch=master)](https://travis-ci.org/dustinhsiao21/birdboard)[![StyleCI](https://github.styleci.io/repos/191885268/shield?branch=master)](https://github.styleci.io/repos/191885268)

this is for laravel demo

![demo](./public/images/demo.png)

## Install

1. You could download this repo.
2. Set up your database information in your .env(use the .env.example as an example);
3. Type the following commands:

```
composer install
php artisan key:generate
php artisan migrate
npm install
npm run dev
```

And You Can Enjoy the Demo!

## Feature

1. You could create a project with tasks.
2. You could create a task for a project.
3. You could update the project's informations.
4. If you're the project's owner, you could delete the project and invite others user in this application.