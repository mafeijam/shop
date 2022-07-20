<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class Shopify
{
    public function getProducts(array $variables = [])
    {
        $resp = Http::shopify('products', $variables);

        if ($resp->json('errors')) {
            throw new Exception($resp->json('errors.0.message'));
        }

        // return $resp->json();

        return $resp->collect('data.products.edges')->flatten(1)
            ->map(function ($p) {
                $variants = Arr::get($p, 'variants.edges');
                $p['variants'] = Arr::flatten($variants, 2);

                return $p;
            });
    }

    public function getCart(array $variables = [])
    {
        return Http::shopify('cart', $variables)->json('data.cart');

        // if ($id = $request->cookie('shopify-cart')) {
        //     $resp = Http::shopify('cart', ['id' => $id])->json();

        // } else {
        //     $cart = $this->createCart();
        // }
    }

    public function createCart()
    {
        $resp = Http::shopify('createCart');

        return $resp;
    }

    protected function normalizeInput(array $input)
    {
        return collect($input)->mapWithKeys(function ($val, $key) {
            $key = "{{$key}}";

            return [$key => $val];
        })->toArray();
    }

    public static function boot()
    {
        Http::macro('shopify', function ($graphql, $variables = []) {
            $shopName = config('shopify.shop_name');
            $query = Storage::disk('gql')->get("{$graphql}.graphql");

            $body['query'] = $query;

            if (count($variables)) {
                $body['variables'] = $variables;
            }

            return Http::withHeaders([
                'X-Shopify-Storefront-Access-Token' => config('shopify.storefront_token'),
            ])
            ->baseUrl("https://{$shopName}.myshopify.com/api/2022-07/graphql.json")
            ->throw()
            ->post('/', $body);
        });
    }
}
