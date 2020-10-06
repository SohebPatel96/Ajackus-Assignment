<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    $activityTypes = [
        ['name' => 'Miles', 'value' => constants('ACTIVITY_TYPE.MILE')],
    ];
    $countries = [
        ['name' => 'USA', 'value' => constants('COUNTRY.USA')],
        ['name' => 'UK', 'value' => constants('COUNTRY.UK')],
    ];

    $modes = [
        ['name' => 'Diesel Car', 'value' => constants('MODE.DIESEL_CAR')],
        ['name' => 'Petrol Car', 'value' => constants('MODE.PETROL_CAR')],
        ['name' => 'Taxi', 'value' => constants('MODE.TAXI')],
        ['name' => 'Bus', 'value' => constants('MODE.BUS')],
        ['name' => 'Transit Rail', 'value' => constants('MODE.TRANSIT_RAIL')],
    ];
    return view('index', ['activityTypes' => $activityTypes, 'countries' => $countries, 'modes' => $modes]);
});
