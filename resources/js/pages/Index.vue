<template>
  <div>
    <component
      :is="$sb(blok.component)"
      v-for="blok in story.content.bloks"
      :key="blok._uid"
      :blok="blok"
    />

    <div class="container mx-auto h-full flex-grow px-3 py-8 md:px-6">
      <div class="mt-3 flex h-full flex-col items-center justify-center">
        <div class="text-3xl">準備中...</div>
        <IxImg
          src="/food.jpg"
          sizes="100vw"
          :imgix-params="{ ar: '16:9', fit: 'crop' }"
          class="aspect-[16/9] w-full"
          alt="img"
        />
        <div>{{ story.content.body }}</div>
        <pre class="max-w-full">{{ products }}</pre>
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
  products: {
    type: Object,
    default: Object,
  },
})
</script>
