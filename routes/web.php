<?php

Route::view('/', 'home')->name('home');
Route::view('/quienes-somos', 'about')->name('about');

Route::resource('portafolio', 'ProjectController')
    ->parameters(['portafolio' => 'project'])
    ->names('projects');
Route::patch('portafolio/{project}/restore', 'ProjectController@restore')
    ->name('projects.restore');
Route::delete('portafolio/{project}/forceDelete', 'ProjectController@forceDelete')
    ->name('projects.forceDelete');

Route::get('categorias/{category}', 'CategoryController@show')->name('categories.show');

Route::view('/contacto', 'contact')->name('contact');
Route::post('contact', 'MessageController@store')->name('messages.store');

Auth::routes(['register' => false]);
