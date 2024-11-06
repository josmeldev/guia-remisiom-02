<?php

namespace App\Http\Middleware;

use App\Http\Controllers\userController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;




class CheckRole
{
    
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect('login');
        }

        // Obtener usuario actual
        $user = Auth::user();

        // Verificar si el usuario tiene alguno de los roles especificados
        foreach ($roles as $role) {
            if ($user->hasRole($role)) {
                return $next($request);
            }
        }

        // Si no tiene ningún rol permitido, devolver error 403
        abort(403, 'No tienes permiso para acceder a esta sección.');

        return $next($request);
    }
}