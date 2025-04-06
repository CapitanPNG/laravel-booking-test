<?php



namespace Database\Seeders;



use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\Models\Customer;



class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run () : void
    {
        // (Creating the records)
        #Customer::factory()->count(10)->create();



        foreach ( range( 1, 10 ) as $i )
        {// Processing each entry
            // (Inserting the record)
            DB::table('customers')->insert
            (
                [
                    'name'       => Str::random( 10 ),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            )
            ;
        }
    }
}
