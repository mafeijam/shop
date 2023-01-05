<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storyblok\ApiException;
use Storyblok\Client as Storyblok;

class StoryblokController extends Controller
{
    public function __invoke(Storyblok $storyblok, Request $request, $lang = null, $slug = null)
    {
        if ($request->has('nocache')) {
            $storyblok->deleteCacheBySlug("$lang/$slug");
        }

        if (method_exists($this, $slug)) {
            return app()->call([$this, $slug]);
        }

        try {
            $story = $storyblok->getStoryBySlug("$lang/$slug")->getBody();

            return inertia('Storyblok', ['story' => $story['story']]);
        } catch (ApiException $e) {
            return inertia('NotFound');
        }
    }

    public function eat()
    {
        return inertia('Eat');
    }

    public function flush(Storyblok $storyblok)
    {
        $storyblok->flushCache();

        return 'ok';
    }
}
