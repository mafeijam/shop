<template>
  <div v-editable="blok" class="swiper-vars container mx-auto">
    <VueSwiper
      loop
      grab-cursor
      :autoplay="{
        delay: 5000,
        pauseOnMouseEnter: true,
      }"
      :navigation="{
        prevEl: '.swiper-btn-prev',
        nextEl: '.swiper-btn-next',
      }"
      effect="fade"
      :pagination="{
        clickable: true,
      }"
      :modules="[Pagination, Navigation, EffectFade, Autoplay]"
    >
      <VueSwiperSlide v-for="item in blok.hero_items" :key="item._uid">
        <div class="flex-center h-[50vh] bg-slate-200 p-16">{{ item }}</div>
      </VueSwiperSlide>

      <template #wrapper-end>
        <div class="swiper-btn-prev left-2">
          <i-ri-arrow-drop-left-line></i-ri-arrow-drop-left-line>
        </div>
        <div class="swiper-btn-next right-2">
          <i-ri-arrow-drop-right-line></i-ri-arrow-drop-right-line>
        </div>
      </template>
    </VueSwiper>
  </div>
</template>

<script setup>
import { Pagination, Navigation, EffectFade, Autoplay } from 'swiper'

defineProps({
  blok: {
    type: Object,
    default: Object,
  },
})
</script>
