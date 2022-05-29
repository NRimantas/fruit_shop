<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;


class UserRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $roles)
    {
        return collect($roles)->contains(auth()->user()->role_id) ? $next($request) : back();
        //galim patikrinti daug roliu vienu metu. issitraukiam roles ir tikrinam vienu metu. contains patikrina ar roles yra tas autorizuotas useris. jeigu true, varom toliau, jei ne, siunciam back
    }
}
