<?php
namespace App\Http\Middleware;

use Closure;

class CrossDomain
{

    public function handle($request, Closure $next, $guard = null)
    {

        $headers = array(
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Credentials' => true,
            'Access-Control-Allow-Methods' => 'GET,POST,OPTIONS',
            'Access-Control-Allow-Headers' => 'X-Requested-With, Content-Type, X-Auth-Token, Origin, Authorization'
        );
        if ($request->getMethod() == "OPTIONS") {
            // The client-side application can set only headers allowed in Access-Control-Allow-Headers
            $response = \Response::make('OK', 200, $headers);
        } else {
            $response = $next($request);
        }

        foreach ($headers as $key => $value) {
            $response->header($key, $value);
        }
        return $response;
    }
}

 ?>
