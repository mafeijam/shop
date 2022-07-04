<template>
  <div v-editable="blok" class="px-6">
    <p class="font-medium">{{ blok.body }}</p>
    <component
      :is="$getStoryComponent(subblok.component)"
      v-for="subblok in blok.bloks"
      :key="subblok._uid"
      :blok="subblok"
    />
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
