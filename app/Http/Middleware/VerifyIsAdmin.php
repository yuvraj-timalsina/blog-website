<?php

    namespace App\Http\Middleware;

    use Closure;
    use Illuminate\Http\Request;

    class VerifyIsAdmin
    {
        /**
         * Handle an incoming request.
         *
         * @param \Illuminate\Http\Request $request
         * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
         *
         * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
         */
        public function handle(Request $request, Closure $next)
        {
            if (!auth()->user()->isAdmin()) {
                flash('You are not authorized to access this page.', 'danger');

                return to_route('welcome');
            }

            return $next($request);
        }
    }
