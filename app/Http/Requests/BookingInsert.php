<?php



namespace App\Http\Requests;



use Illuminate\Foundation\Http\FormRequest;



class BookingInsert extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize () : bool
    {
        // Returning the value
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules () : array
    {
        // Returning the value
        return
        [
            'customer_id'       => 'required|integer|exists:customers,id',
            'booking_timestamp' => 'required|date_format:Y-m-d H:i:s|after_or_equal:now',
        ]
        ;
    }

    public function messages () : array
    {
        // Returning the value
        return
        [
            'customer_id.required'             => "Field 'customer_id' is required",
            'customer_id.integer'              => "Field 'customer_id' must be an integer",
            'customer_id.exists'               => "Field 'customer_id' must be a valid customer ID",

            'booking_timestamp.required'       => "Field 'booking_timestamp' is required",
            'booking_timestamp.date_format'    => "Field 'booking_timestamp' must be in the format 'Y-m-d H:i:s'",
            'booking_timestamp.after_or_equal' => "Field 'booking_timestamp' must be a future timestamp",
        ]
        ;
    }
}
