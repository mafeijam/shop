<?php

namespace App\Http\Controllers;

use App\Services\Concurrent;
use App\Services\Shopify;
use Illuminate\Support\Facades\Cache;
use Storyblok\ApiException;
use Storyblok\Client as Storyblok;

class HomeController extends Controller
{
    public function index(Shopify $shopify, Storyblok $storyblok, Concurrent $concurrent, $lang = null)
    {
        $lang ??= 'zh-hk';

        // $products = Cache::remember(
        //     'shopify::products',
        //     now()->addMinutes(30),
        //     fn () => $shopify->getProducts()
        // );

        // $cart = $shopify->getCart(['id' => 'gid://shopify/Cart/ede3b150c8b839a72784ac895220ba9e']);

        try {
            [$products, $story] = $concurrent->run([
                fn () => $shopify->getProducts(),
                fn () => $storyblok->getStoryBySlug("$lang/home")->getBody(),
            ]);

            return inertia('Index', ['story' => $story['story'], 'products' => $products]);
        } catch (ApiException $e) {
            return inertia('NotFound');
        }

        return inertia('Index');
    }
}
