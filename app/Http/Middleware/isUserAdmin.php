<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class isUserAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $current_user = User::find($user->id);
        if (!$current_user->confirmed) {
            return redirect()
                    ->route('userConfirmation')
                    ->with('info', 'You should be a confirmed user to access previous page!');
        } else {
            return $next($request);
        }
    }
}
