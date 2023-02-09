<?php

    namespace App\Http\Middleware;

    use App\Models\Category;
    use Closure;
    use Illuminate\Http\Request;

    class VerifyCategoriesCount
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
            if (!Category::count()) {
                flash('You must have at least one category before creating a post.', 'warning');

                return to_route('categories.create');
        }

            return $next($request);
        }
    }
