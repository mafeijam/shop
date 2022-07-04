<template>
  <div v-editable="blok">
    <VueSwiper>
      <VueSwiperSlide v-for="item in blok.hero_items" :key="item._uid">
        <div class="flex-center h-64 bg-slate-400">{{ item }}</div>
      </VueSwiperSlide>
    </VueSwiper>
  </div>
</template>

<script setup>
defineProps({
  blok: {
    type: Object,
    default: Object,
  },
})
</script>
