<?php



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use \App\Http\Middleware\ApiToken as ApiTokenMiddleware;



// (Defining the route for testing sanctum)
Route::get( '/api/user', function (Request $request) { return $request->user(); } )->middleware('auth:sanctum');



// (Defining the route for creating an API token)
Route::get( '/api/token', function () { return ApiTokenMiddleware::API_TOKEN; } );



// (Defining the middleware routes)
Route::middleware
(
    [ /*'auth:sanctum'*/ApiTokenMiddleware::class ]
)
    ->group
    (
        function ()
        {
            // (Creating CRUD-FLUID routes for Booking Controller)
            Route::get('/api/bookings/{id}', 'Booking@find');
            Route::get('/api/bookings', 'Booking@list');
            Route::put('/api/bookings/{id}', 'Booking@update');
            Route::post('/api/bookings', 'Booking@insert');
            Route::delete('/api/bookings/{id}', 'Booking@delete');
        }
)
;