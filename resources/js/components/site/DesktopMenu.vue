<template>
  <div class="container mx-auto hidden justify-between space-x-3 px-6 py-3 xl:flex">
    <SiteLogo class="links" />

    <div class="flex items-center space-x-6">
      <InertiaLink :href="$getLang('about')" class="links text-lg">關於</InertiaLink>
      <InertiaLink :href="$getLang('eat')" class="links text-lg">買野食</InertiaLink>

      <div class="h-3 border-l border-stone-200"></div>

      <div class="flex space-x-4">
        <InertiaLink :href="$page.props.lang_url">
          <i-ri-translate-2 class="icons text-lg" />
        </InertiaLink>

        <i-ri-user-3-line class="icons cursor-pointer text-lg" />
        <i-ri-heart-3-line class="icons cursor-pointer text-lg" />
        <i-ri-shopping-cart-line class="icons cursor-pointer text-lg" />
      </div>
    </div>
  </div>
</template>

<script></script>
