<template>
  <div v-editable="blok" class="grid gap-3 md:grid-cols-2 xl:grid-cols-3">
    <component
      :is="$sb(subblok.component)"
      v-for="subblok in blok.columns"
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
