<?php



namespace App\Repositories;



use App\Models\Booking as Resource;



class Booking
{
    protected Resource $resource;



    public function __construct (Resource $resource)
    {
        // (Getting the value)
        $this->resource = $resource;
    }



    public function exists (int $customer_id, string $booking_timestamp) : bool
    {
        // (Returning the value)
        return $this->resource->where( [ [ 'customer_id', $customer_id ], [ 'booking_timestamp', $booking_timestamp ] ] )->exists();
    }

    public function update (int $customer_id, int $id, array $values) : bool
    {
        if ( !Resource::where( [ [ 'customer_id', $customer_id ], [ 'id', $id ] ] )->update( $values ) )
        {// (Unable to update the record)
            // Returning the value
            return false;
        }



        // Returning the value
        return true;
    }

    public function insert (array $record) : Resource|false
    {
        // (Returning the value)
        return $this->resource->create( $record );
    }

    public function delete (int $customer_id, int $id) : bool
    {
        // (Returning the value)
        return $this->resource->where( [ [ 'customer_id', $customer_id ], [ 'id', $id ] ] )->delete();
    }
}


?>