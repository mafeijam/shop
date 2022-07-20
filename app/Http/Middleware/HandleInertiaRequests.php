<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
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

        return array_merge(parent::share($request), [
            'lang_url' => $this->getLangUrl($request),
            'last_url' => $last,
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

        if ($route->named('eat', 'home')) {
            return $route->parameter('lang');
        }

        if ($route->hasParameter('slug')) {
            return $route->parameter('lang');
        }

        return null;
    }

    protected function getLangUrl(Request $request)
    {
        $route = $request->route();

        if ($route->named('home')) {
            return route('home', [
                'lang' => $route->hasParameter('lang') ? null : 'en-hk',
            ]);
        }

        if ($route->named('eat')) {
            return route($route->getName(), [
                'lang' => null,
            ]);
        }

        if ($route->named('storyblok')) {
            $lang = $route->parameter('lang');
            $slug = $route->parameter('slug');

            if (! $route->hasParameter('slug')) {
                $slug = $lang;
                $lang = 'en-hk';
            } else {
                $lang = null;
            }

            return route('storyblok', [
                'lang' => $lang,
                'slug' => $slug,
            ]);
        }

        return null;
    }
}
