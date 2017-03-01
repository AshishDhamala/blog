<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthorizedUsersMiddleware
{
  public function handle($request, Closure $next)
  {
    // if the user role is normal then log them out and redirect to client home page
    if (Auth::user()->role->name == 'normal') {
      Auth::logout();
      return redirect(route('home'))->with('failure_message', 'Access Denied.');
    }
    return $next($request);
  }
}
