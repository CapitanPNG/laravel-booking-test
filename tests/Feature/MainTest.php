<?php



namespace Tests\Feature;



use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use Tests\TestCase;



class MainTest extends TestCase
{
    public function test_client_insert_a_booking () : void
    {
        // (Sending the request)
        $response = $this->get( '/api/token' );

        // (Checking for the status)
        $response->assertStatus( 200 );

        // (Checking for the content)
        #$response->assertJson( [ 'token' => env('API_TOKEN') ] );



        // (Sending the request)
        $response = $this->postJson
        (
            '/api/bookings',
            [
                'booking_timestamp' => date( 'Y-m-d H:i:s', strtotime( '+ 3 month' ) )
            ],
            [
                'Authorization' => 'Bearer ' . env('API_TOKEN'),
            ]
        )
        ;
#echo json_encode( $response, JSON_PRETTY_PRINT );return;
        // (Checking for the status)
        $response->assertStatus(200);
    }
}
