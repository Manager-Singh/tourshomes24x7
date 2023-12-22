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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('properties',function(){
    $properties = \App\Models\Property::with(['propertyDetails','user','category.categoryTranslation','country.countryTranslation','state.stateTranslation','city.cityTranslation','propertyTranslation','image'])
        ->where('moderation_status',1)
        ->where('status',1)
        ->orderBy('id','desc')
        ->get();
    return $properties;
});
