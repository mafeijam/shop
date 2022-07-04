<template>
  <div v-editable="blok">
    <h3>{{ blok.headline }}</h3>
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
