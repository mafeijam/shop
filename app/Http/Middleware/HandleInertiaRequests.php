<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        $url = $request->getBaseUrl().$request->getRequestUri();
        $last = $request->session()->pull('page_last_url', $url);
        $request->session()->put('page_last_url', $url);
        $route = $request->route();

        return array_merge(parent::share($request), [
            'lang_url' => $this->getLangUrl($request),
            'last_url' => $last,
            'route_name' => $route->getName(),
            'route_params' => $route->parameters(),
            'change_lang' => $this->changedLang($url, $last),
            'current_lang' => $this->getCurrentLang($request),
            'domain' => $request->getSchemeAndHttpHost(),
            'lazy' => $request->inertia() ? null : now(),
        ]);
    }

    protected function changedLang($url, $last)
    {
        $changeLang = false;

        if ((str_starts_with($url, '/en-hk') && ! str_starts_with($last, '/en-hk')) ||
            (! str_starts_with($url, '/en-hk') && str_starts_with($last, '/en-hk'))
        ) {
            $changeLang = true;
        }

        return $changeLang;
    }

    protected function getCurrentLang(Request $request)
    {
        $route = $request->route();
        $lang = $route->parameter('lang');

        return $lang === 'zh-hk' || ! in_array($lang, ['zh-hk', 'en-hk'])
            ? null
            : $lang;
    }

    protected function getLangUrl(Request $request)
    {
        $route = $request->route();

        $lang = $route->parameter('lang');
        $slug = $route->parameter('slug');

        if ($lang === null || ! in_array($lang, ['zh-hk', 'en-hk'])) {
            $slug = "$lang/$slug";
            $lang = 'en-hk';
        } elseif ($lang === 'en-hk') {
            $lang = null;
        }

        $parameterNames = Route::getRoutes()->getByName($route->getName())->parameterNames();

        $routeParam = collect([
            'lang' => $lang,
            'slug' => $slug,
        ])
        ->only($parameterNames)
        ->toArray();

        return route($route->getName(), $routeParam);
    }
}
