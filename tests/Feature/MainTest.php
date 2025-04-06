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
                'customer_id'       => mt_rand( 1, 10 ),
                'booking_timestamp' => date( 'Y-m-d H:i:s', strtotime( '+ 3 month' ) )
            ],
            [
                'Authorization' => 'Bearer ' . env('API_TOKEN'),
            ]
        )
        ;

        // (Checking for the status)
        $response->assertStatus(200);
    }

    public function test_client_insert_a_booking_without_token () : void
    {
        // (Sending the request)
        $response = $this->postJson
        (
            '/api/bookings',
            [
                'customer_id'       => mt_rand( 1, 10 ),
                'booking_timestamp' => date( 'Y-m-d H:i:s', strtotime( '+ 3 month' ) )
            ]
        )
        ;

        // (Checking for the status)
        $response->assertStatus(400);
    }

    public function test_client_insert_a_booking_with_invalid_token () : void
    {
        // (Sending the request)
        $response = $this->postJson
        (
            '/api/bookings',
            [
                'customer_id'       => mt_rand( 1, 10 ),
                'booking_timestamp' => date( 'Y-m-d H:i:s', strtotime( '+ 3 month' ) )
            ],
            [
                'Authorization' => 'Bearer ' . 'invalid_token',
            ]
        )
        ;

        // (Checking for the status)
        $response->assertStatus(401);
    }
}
