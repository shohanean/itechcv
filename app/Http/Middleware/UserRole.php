<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\PersonalInformation;

class UserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(Auth::user()->user_role == 1){
            $category = PersonalInformation::where('user_id', Auth::id())->first()->job_category;

            if (Auth::user()->user_role == 1 and $category == ''){
                return redirect(route('jobTopic'));
            }
        }


        if (Auth::user()->user_role == 2){
            return redirect(route('employerDashboard'));
        }
        if (Auth::user()->user_role == 3){
            return redirect(route('AdminDashboard'));
        }
        return $next($request);
    }
}
