# Laravel-Vue SPA 

<a href="https://travis-ci.org/cretueusebiu/laravel-vue-spa"><img src="https://travis-ci.org/cretueusebiu/laravel-vue-spa.svg?branch=master" alt="Build Status"></a>
<a href="https://packagist.org/packages/cretueusebiu/laravel-vue-spa"><img src="https://poser.pugx.org/cretueusebiu/laravel-vue-spa/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/cretueusebiu/laravel-vue-spa"><img src="https://poser.pugx.org/cretueusebiu/laravel-vue-spa/v/stable.svg" alt="Latest Stable Version"></a>

> A Laravel-Vue SPA starter project template.

<p align="center">
<img src="https://i.imgur.com/NHFTsGt.png">
</p>

## Features

- Laravel 5.8 
- Vue + VueRouter + Vuex + VueI18n + ESlint
- Pages with dynamic import and custom layouts
- Login, register, email verification and password reset
- Authentication with JWT
- Pusher
- Access Control Level (ACL) implemented
- Bootstrap 4 + Font Awesome 5

## Installation

- `composer create-project --prefer-dist cretueusebiu/laravel-vue-spa`
- Edit `.env` and set your database connection details
- (When installed via git clone or download, run `php artisan key:generate` and `php artisan jwt:secret`)
- `php artisan migrate`
- `php artisan db:seed`
- `npm install`

## Configuration

- Edit `resources/js/plugins/axios.js` and set base url in "request interceptor"
- Edit `.env` Add configuration for pusher. Set BROADCAST_DRIVER to pusher and QUEUE_DRIVER to sync
- Edit `resources/js/boostrap.js` Add configuration for pusher
- By default all permissions are assigned to super admin. Super admin need to assign relevant permissions to other roles
- To send out emails, make sure to set up email configurations in `.env`



## Usage

#### Development

```bash
# build and watch
npm run watch

# serve with hot reloading
npm run hot
```

#### Production

```bash
npm run production
```

## Email Verification

To enable email verification make sure that your `App\User` model implements the `Illuminate\Contracts\Auth\MustVerifyEmail` contract.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.
