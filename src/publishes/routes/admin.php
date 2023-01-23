<?php

Route::group(['prefix' => 'admin', 'namespace' => 'App\Http\Controllers\Admin'], function() {
    foreach (scandir(__DIR__) as $file) {
        if (strpos($file, '.php') !== false && $file != 'admin.php') require $file;
    }
});

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');