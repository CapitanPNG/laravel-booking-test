<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;



use \App\Models\Booking as Resource;

use \App\Http\Requests\BookingInsert as InsertRequest;
use \App\Http\Requests\BookingUpdate as UpdateRequest;

use \App\Services\Booking as Service;



class Booking extends Controller
{
    protected Service $service;



    public function __construct (Service $service)
    {
        // (Getting the value)
        $this->service = $service;
    }



    public function find (int $id)
    {
        // (Getting the value)
        $resource = Resource::where( 'id', $id )->first();

        if ( !$resource )
        {// (Record not found)
            return response()->json( [ 'error' => 'Record not found (' . __CLASS__ . ')' ], 404 );
        }



        // Returning the value
        return response()->json( $resource );
    }

    public function list (Request $request)
    {
        switch ( $request->query('format') )
        {
            case 'csv':
                // (Setting the values)
                $column_separator = ';';
                $line_separator   = "\n";



                // (Setting the value)
                $csv_content = '';

                foreach ( Resource::all()->toArray() as $i => $record )
                {// Processing each entry
                    if ( $i === 0 )
                    {// (Line is the first)
                        // (Setting the value)
                        $csv_content .= implode( $column_separator, array_keys( $record ) ) . $line_separator;
                    }



                    // (Appending the value)
                    $csv_content .= implode( $column_separator, array_values( $record ) ) . $line_separator;
                }



                // Returning the value
                return response()->stream( function () use ( $csv_content ) { echo $csv_content; }, 200, [ 'Content-Type' => 'text/csv', 'Content-Disposition' => 'attachment; filename="bookings.csv"' ] );
            break;

            default:
                // Returning the value
                return response()->json( Resource::all() );
        }
    }

    public function update (UpdateRequest $request, int $id)
    {
        // (Getting the value)
        $input = $request->validated();



        /* without service

        // (Getting the value)
        $customer_id = auth()->id;

        if ( Resource::where( [ [ 'customer_id', $customer_id  ], [ 'booking_timestamp', $input['booking_timestamp'] ] ] )->exists() )
        {// (Record found)
            // Returning the value
            return response()->json( [ 'error' => "Key ['customer_id','booking_timestamp'] already exists (" . __CLASS__ . ')' ], 409 );
        }



        // (Getting the value)
        $values =
        [
            'booking_timestamp' => $input[ 'booking_timestamp' ]
        ]
        ;

        if ( !Resource::where( [ [ 'customer_id', $customer_id ], [ 'id', $id ] ] )->update( $values ) )
        {// (Unable to update the record)
            // Returning the value
            return response()->json( [ 'error' => 'Unable to update the record (' . __CLASS__ . ')' ], 500 );
        }

        */



        // (Getting the value)
        #$response = $this->service->update( /*auth()->id*/$input['customer_id'], $id, [ 'booking_timestamp' => $input['booking_timestamp'] ] );
        $response = $this->service->update( $id, [ 'booking_timestamp' => $input['booking_timestamp'] ] );

        if ( $response->code !== 200 )
        {// (Operation failed)
            // Returning the value
            return response()->json( [ 'error' => $response->message ], $response->code );
        }



        // Returning the value
        return response()->json();
    }

    public function insert (InsertRequest $request)
    {
        // (Getting the value)
        $input = $request->validated();



        /* without service

        // (Getting the value)
        $customer_id = auth()->id;

        if ( Resource::where( [ [ 'customer_id', $customer_id  ], [ 'booking_timestamp', $input['booking_timestamp'] ] ] )->exists() )
        {// (Record found)
            // Returning the value
            return response()->json( [ 'error' => "Key ['customer_id','booking_timestamp'] already exists (" . __CLASS__ . ')' ], 409 );
        }



        // (Getting the value)
        $record =
        [
            'customer_id'       => $customer_id,
            'booking_timestamp' => $input[ 'booking_timestamp' ],
        ]
        ;

        // (Inserting the record)
        $resource = Resource::create( $record );

        if ( !$resource )
        {// (Unable to insert the record)
            // Returning the value
            return response()->json( [ 'error' => 'Unable to insert the record (' . __CLASS__ . ')' ], 500 );
        }

        */



        // (Getting the value)
        $record =
        [
            #'customer_id'       => auth()->id,
            'customer_id'       => $input['customer_id'],
            'booking_timestamp' => $input['booking_timestamp'],
        ]
        ;

        // (Getting the value)
        $response = $this->service->insert( $record );

        if ( $response->code !== 200 )
        {// (Operation failed)
            // Returning the value
            return response()->json( [ 'error' => $response->message ], $response->code );
        }



        // Returning the value
        return response()->json( $response->data );
    }

    public function delete (int $id)
    {
        /* without service

        if ( !Resource::where( [ [ 'customer_id', auth()->id ], [ 'id', $id ] ] )->delete() )
        {// (Unable to delete the resource)
            // Returning the value
            return response()->json( [ 'error' => 'Unable to delete the resource (' . __CLASS__ . ')' ], 500 );
        }

        */



        // (Getting the value)
        #$response = $this->service->delete( auth()->id, $id );
        $response = $this->service->delete( $id );

        if ( $response->code !== 200 )
        {// (Operation failed)
            // Returning the value
            return response()->json( [ 'error' => $response->message ], $response->code );
        }



        // Returning the value
        return response()->json();
    }
}
