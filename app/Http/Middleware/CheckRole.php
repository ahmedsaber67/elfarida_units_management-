<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     * Usage in routes: ->middleware('role:admin') or 'role:admin,supervisor'
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error','يجب تسجيل الدخول أولاً');
        }

        // إذا الأدوار تمررت كقائمة
        if ($roles && !in_array($user->role, $roles)) {
            // يمكن تخصيص redirect أو 403
            abort(403, 'غير مصرح لك بالدخول لهذه الصفحة.');
        }

        return $next($request);
    }
}
