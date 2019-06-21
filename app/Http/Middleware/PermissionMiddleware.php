<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionMiddleware
{
    public function handle($request, Closure $next)
    {
        if (app('auth')->guest()) {
            throw UnauthorizedException::notLoggedIn();
        }
        $role = Role::find(Auth::user()->id);

        $permissions = $role->permissions()->pluck('name')->toArray();
        
        foreach ($permissions as $permission) {
            if (app('auth')->user()->can($permission)) {
                return $next($request);
            }
        }

        throw UnauthorizedException::forPermissions($permissions);
        exit;
        if($role->type=='admin'){
             return $next($request);
        }



        dd($type);
        exit;
        $user = Auth::user();

        $permission = $user->permissions;
        // print_r(app('auth')->user()->permissions);
        dd($permission);
        exit;
        $permissions = is_array($permission)
            ? $permission
            : explode('|', $permission);
            
        foreach ($permissions as $permission) {
            if (app('auth')->user()->can($permission)) {
                return $next($request);
            }
        }

        throw UnauthorizedException::forPermissions($permissions);
    }
}