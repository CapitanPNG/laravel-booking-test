<?php



use Illuminate\Support\Facades\Route;



// (Defining the base route)
Route::get( '/', function () { return view('Booking Web App'); } );



// (Defining the middleware routes)
Route::middleware
(
    [ 'auth' ]
)
    ->group
    (
        function ()
        {
            // (Creating CRUD-FLUID routes for BookingController)
            Route::get('/bookings/{id}', 'Booking@find')->middleware('user');
            Route::get('/bookings', 'Booking@list')->middleware('user');
            Route::put('/bookings/{id}', 'Booking@update')->middleware('user');
            Route::post('/bookings', 'Booking@insert')->middleware('user');
            Route::delete('/bookings/{id}', 'Booking@delete')->middleware('user');
        }
)
;