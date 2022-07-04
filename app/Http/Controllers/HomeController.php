<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storyblok\ApiException;
use Storyblok\Client as Storyblok;

class HomeController extends Controller
{
    public function index(Storyblok $storyblok, $lang = null)
    {
        $lang ??= 'zh-hk';

        try {
            $story = $storyblok->getStoryBySlug("$lang/home")->getBody();

            return inertia('Index', ['story' => $story['story']]);
        } catch (ApiException $e) {
            return inertia('NotFound');
        }

        return inertia('Index');
    }
}
