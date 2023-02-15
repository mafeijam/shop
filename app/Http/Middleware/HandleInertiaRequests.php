<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
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
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
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
            'changed_lang' => $this->changedLang($url, $last),
            'current_lang' => $this->getCurrentLang($request),
            'domain' => $request->getSchemeAndHttpHost(),
            'is_public' => Str::of($request->getHost())->contains('jamwong.me'),
            'lazy' => $request->inertia() ? null : now(),
        ]);
    }

    protected function changedLang($url, $last)
    {
        if ((str_starts_with($url, '/en-hk') && ! str_starts_with($last, '/en-hk')) ||
            (! str_starts_with($url, '/en-hk') && str_starts_with($last, '/en-hk'))
        ) {
            return true;
        }

        return false;
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
        $name = $route->getName();

        if ($name === 'flush') {
            return null;
        }

        $lang = $route->parameter('lang');
        $slug = $route->parameter('slug');

        if ($lang === null || ! in_array($lang, ['zh-hk', 'en-hk'])) {
            $slug = "$lang/$slug";
            $lang = 'en-hk';
        } elseif ($lang === 'en-hk') {
            $lang = null;
        }

        $parameterNames = Route::getRoutes()->getByName($name)->parameterNames();

        $routeParams = collect([
            'lang' => $lang,
            'slug' => $slug,
        ])
        ->only($parameterNames)
        ->toArray();

        return route($name, $routeParams);
    }
}
