<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <title>好味漢堡包店</title>
    <meta name="page:lazy" content="{{ $page['props']['lazy'] }}">
    <meta name="title" content="好味漢堡包店">
    <meta name="description" content="好味漢堡包店">

    @include('partial._adobe-font')

    @vite(['resources/js/app.js'])

    @inertiaHead
  </head>
  <body>
    <div id="teleport"></div>

    @inertia

    @includeWhen($page['props']['is_public'], 'partial._gtag')
  </body>
</html>
