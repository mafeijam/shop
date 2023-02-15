<template>
  <div class="container mx-auto hidden h-16 justify-between space-x-3 px-6 xl:flex">
    <SiteLogo class="links" />

    <div class="flex items-center space-x-10">
      <InertiaLink
        :href="$getUrlWithLang('/', $page)"
        class="links grid h-full content-center text-lg"
        :class="{ 'link-active': $isLinkActive('/', $page) }"
      >
        首頁
      </InertiaLink>
      <InertiaLink
        :href="$getUrlWithLang('about', $page)"
        class="links grid h-full content-center text-lg"
        :class="{ 'link-active': $isLinkActive('about', $page) }"
      >
        關於
      </InertiaLink>
      <InertiaLink
        :href="$getUrlWithLang('eat', $page)"
        class="links grid h-full content-center text-lg"
        :class="{ 'link-active': $isLinkActive('eat', $page) }"
      >
        買野食
      </InertiaLink>

      <div class="h-3 border-l border-stone-200" />

      <div class="flex space-x-5">
        <InertiaLink :href="$page.props.lang_url">
          <i-ri:translate-2 class="icons text-lg" />
        </InertiaLink>

        <i-ri:user-3-line class="icons cursor-pointer text-lg" />
        <i-ri:heart-3-line class="icons cursor-pointer text-lg" />
        <i-ri:shopping-cart-line class="icons cursor-pointer text-lg" />
      </div>
    </div>
  </div>
</template>

<script></script>
