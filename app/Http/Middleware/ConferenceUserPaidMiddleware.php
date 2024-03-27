<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Conference;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConferenceUserPaidMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $conference = Conference::active_conference();
        if(auth()->user()->paid_status_set_for($conference)){
            return $next($request);
        }else{
            return redirect(route('user_participants',['user'=>auth()->user(),'conference'=>$conference]))->with('warning','Please Clarify this first!.');
        }
    }
}
