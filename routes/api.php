<?php



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use \App\Http\Middleware\ApiToken as ApiTokenMiddleware;

use \App\Http\Controllers\Booking as BookingController;



// (Defining the route for testing sanctum)
Route::get( '/user', function (Request $request) { return $request->user(); } )->middleware('auth:sanctum');



// (Defining the route for creating an API token)
Route::get( '/token', function () { return env( 'API_TOKEN' ); } );



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
            Route::get('/bookings/{id}', [ BookingController::class, 'find' ] );
            Route::get('/bookings', [ BookingController::class, 'list' ] );
            Route::put('/bookings/{id}', [ BookingController::class, 'update' ] );
            Route::post('/bookings', [ BookingController::class, 'insert' ] );
            Route::delete('/bookings/{id}', [ BookingController::class, 'delete' ] );
        }
)
;