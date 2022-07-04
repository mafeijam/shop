<template>
  <div>
    <component
      :is="$getStoryComponent(blok.component)"
      v-for="blok in story.content.bloks"
      :key="blok._uid"
      :blok="blok"
    ></component>

    <div class="container mx-auto h-full flex-grow px-6 py-8">
      <div class="mt-3 flex h-full flex-col items-center justify-center">
        <div class="text-3xl">準備中...</div>
        <div>{{ story.content.body }}</div>
      </div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  story: {
    type: Object,
    default: Object,
  },
})
</script>
