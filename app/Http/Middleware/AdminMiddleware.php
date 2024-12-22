<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = User::where('id' , $request->user()->id)->first();
  
        if(!$user)
        {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        if(!$user->is_admin)
        {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        return $next($request);
    }
}
