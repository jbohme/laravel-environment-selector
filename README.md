<h1 style="text-align: center"><img src="icon.png" alt="MarineGEO circle logo" style="height: 200px; width:200px;"/>
<br>
<p>Laravel Environment Selector</p></h1>

This package is intended to make it easier to choose the .env. You can have *".env.testing"*, *".env.development"* among others.

## Installation

Install the package through [composer](http://getcomposer.org):

```bash
composer require jbohme/laravel-environment-selector
```
You must publish a project configuration with:

```bash
php artisan vendor:publish --tag=laravel-env-selector
php artisan config:cache
```

After this the *env-selector.json* was created in the root.
## Usage

Run the command to modify *bootstrap/app.php* to enable environment selection.

```bash
php artisan publish-env-selector
```

Change the environment in the *env-selector.json* file.

## [](https://github.com/jbohme/laravel-environment-selector/blob/master/LICENSE.md) License

Laravel Horizon is open-sourced software licensed under the [MIT license](https://github.com/jbohme/laravel-environment-selector/blob/master/LICENSE.md).
