<?php
    
    namespace App\Http\Middleware;
    
    use Closure;
    use Illuminate\Support\Facades\Gate;
    
    class RestrictedUser
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
            if (collect(['show', 'edit', 'update'])->contains($request->route()->getActionMethod())) {
                return $next($request);
            }
            
            abort_unless(Gate::allows('manage.users'), 403);
            
            return $next($request);
        }
    }
