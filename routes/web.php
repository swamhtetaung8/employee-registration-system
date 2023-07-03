<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

//For unauthenticated users
Route::middleware('emp.unauthenticated')->group(function(){
    Route::name('auth.')->group(function(){
        //Login view
        Route::get('/', 'AuthController@login')->name('login');
        //Login handling
        Route::post('/login', 'AuthController@check')->name('check');
    });
});

//For authenticated users
Route::middleware('emp.authenticated')->group(function(){
    //Employee CRUD
    Route::resource('employees','EmployeeController');

    Route::prefix('employees')->name('employees.')->group(function(){
        //Employee inactive handling
        Route::post('/inactive/{id}','EmployeeController@inactive')->name('inactive');
        //Employee active handling
        Route::post('/active/{id}','EmployeeController@active')->name('active');
        //Excel format export
        Route::get('/excel/export','ExcelController@export')->name('excelexport');
        //Excel import
        Route::post('/excel/import','ExcelController@import')->name('excelimport');
    });

    //PDF and Excel Download
    Route::get('/download','EmployeeController@download')->name('employees.download');

    //Logout handling
    Route::post('/logout', 'AuthController@logout')->name('auth.logout');
});
