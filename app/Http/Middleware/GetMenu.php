<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class GetMenu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$role)
    {
        $role = Role::with(['menu' => function ($query) {
            $query->with('menu_detail');
            $query->with('sub_menu.sub_menu_detail');
        }])->where('id', Auth::user()->role_id)->first();

        // dd($role->menu);

        view()->share('role', $role);
        return $next($request);
    }
}
