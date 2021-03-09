<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Register User
Route::post('/register', 'Api\RegisterController@store')->name('api.register.store');

// Authentication
Route::post('/login', 'Api\AuthController@login')->name('api.login');

// Access by permission
Route::middleware('auth:api')->get('/user', 'Api\Security\UserController@getAuthUser');
Route::middleware('auth:api')->apiResource('/security/users', 'Api\Security\UserController');
Route::middleware('auth:api')->apiResource('/security/permissions', 'Api\Security\PermissionController');
Route::middleware('auth:api')->apiResource('/security/roles', 'Api\Security\RoleController');
