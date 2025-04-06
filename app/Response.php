<?php



namespace App;



class Response
{
    public int $code       = 200;
    public string $message = 'OK';
    public mixed $data     = null;



    public function __construct (int $code, string $message, mixed $data = null)
    {
        // (Getting the values)
        $this->code    = $code;
        $this->message = $message;
        $this->data    = $data;
    }



    public function __toString () : string
    {
        // Returning the value
        return $this->code . ' -> ' . $this->message;
    }
}



?>