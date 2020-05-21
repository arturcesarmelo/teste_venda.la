<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {

    $router->post('register', 'AuthController@register');
    $router->post('login', 'AuthController@login');

    $router->group(['middleware' => ['auth']], function() use ($router) {
        $router->post('suppliers', 'SupplierController@store');
        $router->get('suppliers', 'SupplierController@index');
        $router->get('suppliers/{id}', 'SupplierController@show');
        $router->put('suppliers/{id}', 'SupplierController@update');
        $router->delete('suppliers/{id}', 'SupplierController@destroy');
    
        $router->post('product', 'ProductController@store');
        $router->get('products', 'ProductController@index');
        $router->get('products/{id}', 'ProductController@show');
        $router->put('products/{id}', 'ProductController@update');
        $router->delete('products/{id}', 'ProductController@destroy');
    });
});