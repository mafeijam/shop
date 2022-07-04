<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <title>好味漢堡包店</title>
    <meta name="page:lazy" content="{{ $page['props']['lazy'] }}">

    <script src="https://unpkg.com/@shopify/app-bridge@3.1.0"></script>
    <script src="https://unpkg.com/@shopify/app-bridge-utils@3.1.0"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
          var appBridgeUtils = window['app-bridge-utils'];

          console.log(appBridgeUtils.isShopifyEmbedded())
      })
  </script>

    @include('partial._adobe-font')

    @vite(['resources/js/app.js'])

    @inertiaHead
  </head>
  <body>
    <div id="teleport"></div>
    @inertia
  </body>
</html>
