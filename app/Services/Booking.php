<?php



namespace App\Services;



use \Illuminate\Support\Facades\Log;

use \App\Repositories\Booking as Repository;

use \App\Response;



class Booking
{
    protected Repository $repository;



    public function __construct (Repository $repository)
    {
        // (Getting the value)
        $this->repository = $repository;
    }



    public function update (int $id, array $values) : Response
    {
        if ( $this->repository->exists( $values['booking_timestamp'] ) )
        {// (Record found)
            // Returning the value
            return new Response( 409, "Key 'booking_timestamp' already exists (" . __CLASS__ . ')' );
        }



        if ( !$this->repository->update( $id, $values ) )
        {// (Unable to update the record)
            // Returning the value
            return new Response( 500, 'Unable to update the record (' . __CLASS__ . ')' );
        }



        // (Pushing the message)
        Log::info( __CLASS__ . ' ' . $id . ' has been updated' );



        // (Returning the value)
        return new Response( 200, 'OK' );
    }

    public function insert (array $record) : Response
    {
        if ( $this->repository->exists( $record['booking_timestamp'] ) )
        {// (Record found)
            return new Response( 409, "Key 'booking_timestamp' already exists (" . __CLASS__ . ")" );
        }



        // (Inserting the record)
        $resource = $this->repository->insert( $record );

        if ( !$resource )
        {// (Unable to insert the record)
            return new Response( 500, 'Unable to insert the record (' . __CLASS__ . ')' );
        }



        // (Pushing the message)
        Log::info( __CLASS__ . " {$resource->id} has been inserted :: " . json_encode( $record ) );



        // (Returning the value)
        return new Response( 200, 'OK', $resource->id );
    }

    public function delete (int $id) : Response
    {
        if ( !$this->repository->delete( $id ) )
        {// (Unable to delete the record)
            return new Response( 500, 'Unable to delete the record (' . __CLASS__ . ')' );
        }



        // (Pushing the message)
        Log::info( __CLASS__ . " {$id} has been deleted" );



        // (Returning the value)
        return new Response( 200, 'OK' );
    }
}



?>