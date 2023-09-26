<template>
  <div
    class="relative flex flex-col flex-wrap p-5 transition lg:flex-row xl:h-52 xl:p-8 xl:hover:shadow-lg xl:hover:shadow-stone-300/50"
    @mouseover="show = true"
    @mouseleave="show = false"
  >
    <SiteBadge v-if="burger <= 2" color="red"> 新野 </SiteBadge>
    <SiteBadge v-if="[3, 5].includes(burger)" color="blue">限定</SiteBadge>

    <div class="flex h-32 items-center justify-center lg:w-1/3 xl:h-full">
      <img
        :src="`https://jamwong.me/static/foods/burger-${burger}.png`"
        alt="burger"
        class="h-full w-full object-contain"
      />
    </div>

    <div class="lg:h-ful flex py-8 lg:w-2/3 lg:py-0 lg:pl-6">
      <div class="flex flex-col gap-3">
        <div class="text-2xl font-medium text-stone-600">漢堡包</div>
        <div class="flex-grow font-light leading-snug text-stone-500">
          some description more and more
        </div>
        <div class="text-xl font-bold text-rose-500">$200</div>
      </div>
    </div>

    <Transition v-if="isDesktop" name="product">
      <div
        v-show="show"
        class="absolute bottom-0 right-0 flex w-full select-none items-center justify-end space-x-6 bg-gradient-to-b from-white/20 via-white/40 to-stone-200/60 p-4"
      >
        <button class="text-2xl text-stone-300 transition hover:text-rose-500 active:text-rose-600">
          <i-ri-heart-add-fill />
        </button>

        <button
          class="rounded-md bg-stone-200 px-4 py-2 text-sm text-stone-500 transition hover:bg-rose-500 hover:text-stone-100 hover:ring-4 hover:ring-rose-300 focus:outline-none focus:ring-4 focus:ring-stone-300 hover:focus:ring-rose-300 active:bg-rose-600 active:ring-rose-400"
        >
          加入購物車
        </button>
      </div>
    </Transition>

    <div v-else class="flex justify-end gap-6 lg:w-full lg:pt-6">
      <button class="text-2xl text-stone-300 transition hover:text-rose-500 active:text-rose-600">
        <i-ri-heart-add-fill />
      </button>

      <button
        class="rounded-md bg-stone-200 px-4 py-2 text-sm text-stone-500 transition hover:bg-rose-500 hover:text-stone-100 hover:ring-4 hover:ring-rose-300 focus:outline-none focus:ring-4 focus:ring-stone-300 hover:focus:ring-rose-300 active:bg-rose-600 active:ring-rose-400"
      >
        加入購物車
      </button>
    </div>
  </div>
</template>

<script setup>
import { breakpointsTailwind, useBreakpoints } from '@vueuse/core'

defineProps({
  burger: {
    type: Number,
    default: 1,
  },
})

let show = ref(false)

const breakpoints = useBreakpoints(breakpointsTailwind)
const isDesktop = breakpoints.greater('xl')
</script>
