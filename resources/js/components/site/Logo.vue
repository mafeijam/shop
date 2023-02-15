<template>
  <InertiaLink
    :href="home"
    class="flex items-center space-x-3 justify-self-center text-lg transition"
  >
    <img
      src="https://jamwong.me/static/icons8-hamburger-100.png"
      class="h-10 object-contain"
      alt="logo"
    >
    <div>好味漢堡包店</div>
  </InertiaLink>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3'

const page = usePage()

const home = computed(() => {
  if (page.props.current_lang) {
    return `/${page.props.current_lang}`
  }

  return '/'
})
</script>
