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
        Route::post('/inactive/{employee}','EmployeeController@inactive')->name('inactive');
        //Employee active handling
        Route::post('/active/{employee}','EmployeeController@active')->name('active');
        //Delete employee's photo
        Route::put('/delete-photo/{employee}','EmployeeController@deletePhoto')->name('deletePhoto');
        //Excel format export
        Route::get('/excel/export','ExcelController@export')->name('excelexport');
        //Excel import
        Route::post('/excel/import','ExcelController@import')->name('excelimport');
    });

    //To handle language changes
    Route::get('/locale/{lang}','LocalizationController@changeLang')->name('lang');

    //PDF and Excel Download
    Route::get('/download','EmployeeController@download')->name('employees.download');

    //Logout handling
    Route::post('/logout', 'AuthController@logout')->name('auth.logout');
});
