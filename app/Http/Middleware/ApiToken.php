<?php



namespace App\Http\Middleware;



use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;



class ApiToken
{
    const API_TOKEN = 'ahcid';



    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle (Request $request, Closure $next) : Response
    {
        if ( !$request->hasHeader('Authorization') )
        {// (Header not found)
            // Returning the value
            return response()->json( [ 'error' => "Header 'Authorization' not found" ], 400 );
        }



        // (Getting the values)
        [ $auth_type, $auth_token ] = explode( ' ', $request->header( 'Authorization' ), 2 );



        if ( $auth_type !== 'Bearer' )
        {// Match failed
            // Returning the value
            return response()->json( [ 'error' => "Authorization type '$auth_type' not supported" ], 400 );
        }

        if ( !hash_equals( self::API_TOKEN, $auth_token ) )
        {// Match failed
            // Returning the value
            return response()->json( [ 'error' => "Token '$auth_token' not valid" ], 401 );
        }



        // Returning the value
        return $next($request);
    }
}
