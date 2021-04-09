<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'    => 'cms',
    'namespace' => 'Admin',
], function (Router $router) {
    $router->resource('articles', 'ArticleController');
    $router->resource('categories', 'CategoryController');
});
