<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Blog;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class addblogMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       if(auth()->user()->name=='jamal'){
        return $next($request);
       }
       return response('Error');
    }

}
