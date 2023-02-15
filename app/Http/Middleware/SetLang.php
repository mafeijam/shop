<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class SetLang
{
    protected $allowLangs = [
        'zh-hk',
        'en-hk',
    ];

    public function handle(Request $request, Closure $next)
    {
        $route = $request->route();

        if ($route->hasParameter('slug')) {
            return $this->handleWithSlug($request, $next, $route);
        }

        if (! $route->hasParameter('slug')) {
            return $this->handleWithoutSlug($request, $next, $route);
        }

        return $next($request);
    }

    protected function handleWithSlug(Request $request, Closure $next, $route)
    {
        $lang = $route->parameter('lang');
        $slug = $route->parameter('slug');

        if (Route::has($slug)) {
            $parameterNames = Route::getRoutes()->getByName($slug)->parameterNames();

            $routeParam = collect([
                'lang' => $lang === 'zh-hk' ? null : $lang,
                'slug' => $slug,
            ])
            ->only($parameterNames)
            ->toArray();

            return redirect()->route($slug, $routeParam);
        }

        if ($lang === 'zh-hk') {
            return redirect()->route('storyblok', [
                'lang' => null,
                'slug' => $slug,
            ]);
        }

        if (! in_array($lang, $this->allowLangs)) {
            $route->setParameter('lang', 'zh-hk');
            $route->setParameter('slug', "$lang/$slug");
        }

        return $next($request);
    }

    protected function handleWithoutSlug(Request $request, Closure $next, $route)
    {
        $slug = $route->parameter('lang');

        if ($slug === 'zh-hk') {
            return redirect()->route('home');
        }

        $route->setParameter('lang', 'zh-hk');
        $route->setParameter('slug', $slug);

        return $next($request);
    }
}
