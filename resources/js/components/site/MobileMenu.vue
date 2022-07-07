<template>
  <Teleport to="#teleport">
    <Transition name="menu">
      <div
        v-if="show"
        ref="menu"
        class="fixed top-0 left-0 z-50 h-full w-full bg-stone-50 md:inset-auto md:max-w-[350px] md:border-r md:border-stone-200 md:shadow-lg md:shadow-stone-300/70"
      >
        <div
          class="grid w-full grid-cols-12 place-items-center bg-stone-200 px-3 py-3 md:bg-stone-50 md:px-6"
        >
          <i-ri-close-line
            class="col-span-3 cursor-pointer justify-self-start text-3xl text-stone-500 transition hover:text-stone-700"
            @click="show = false"
          />

          <SiteLogo class="links col-span-6 md:hidden" />
        </div>

        <div class="mx-6 flex justify-evenly space-x-6 border-b border-stone-200/80 py-6 md:hidden">
          <InertiaLink :href="$page.props.lang_url">
            <i-ri-translate-2 class="icons text-2xl" @click="show = false" />
          </InertiaLink>
          <i-ri-user-3-line class="icons cursor-pointer text-2xl" />
          <i-ri-heart-3-line class="icons cursor-pointer text-2xl" />
          <i-ri-shopping-cart-line class="icons cursor-pointer text-2xl" />
        </div>

        <div class="flex flex-col divide-y divide-stone-200/80 px-6" @click="show = false">
          <InertiaLink :href="$getLang('about')" class="links py-4 text-2xl">關於</InertiaLink>
          <InertiaLink :href="$getLang('eat')" class="links py-4 text-2xl">買野食</InertiaLink>
        </div>
      </div>
    </Transition>
  </Teleport>

  <div
    class="flex w-full place-items-center gap-6 px-3 py-3 md:grid md:grid-cols-12 md:gap-0 md:px-6 xl:hidden"
  >
    <div class="justify-self-start md:col-span-3">
      <i-ri-menu-line class="icons o cursor-pointer text-2xl" @click="show = !show" />
    </div>

    <SiteLogo class="links w-full md:col-span-6 md:w-auto" />

    <div class="hidden space-x-5 justify-self-end md:col-span-3 md:flex">
      <InertiaLink :href="$page.props.lang_url">
        <i-ri-translate-2 class="icons text-xl" />
      </InertiaLink>

      <i-ri-user-3-line class="icons cursor-pointer text-xl" />
      <i-ri-heart-3-line class="icons cursor-pointer text-xl" />
      <i-ri-shopping-cart-line class="icons cursor-pointer text-xl" />
    </div>

    <div class="flex space-x-4 justify-self-end md:hidden">
      <i-ri-user-3-line class="icons cursor-pointer justify-self-end text-2xl" />
      <i-ri-shopping-cart-line class="icons cursor-pointer justify-self-end text-2xl" />
    </div>
  </div>
</template>

<script setup>
import { onClickOutside, useSwipe, SwipeDirection } from '@vueuse/core'

const show = ref(false)
const menu = ref(null)

useSwipe(menu, {
  threshold: 100,
  onSwipeEnd(e, dir) {
    if (dir === SwipeDirection.LEFT) {
      show.value = false
    }
  },
})

onClickOutside(menu, () => (show.value = false))

watch(show, () => document.body.classList.toggle('overflow-hidden'))
</script>
