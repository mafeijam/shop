<template>
  <div class="absolute -top-2 -left-2 rotate-[-8deg] rounded-lg py-1 px-3 text-sm" :class="color">
    <slot></slot>
  </div>
</template>

<script setup>
const props = defineProps({
  color: {
    type: String,
    default: 'red',
  },
})

const color = computed(() => {
  return (
    {
      red: 'bg-rose-50 text-rose-600 shadow-md shadow-rose-300/30',
      blue: 'bg-sky-100 text-sky-600 shadow-md shadow-sky-300/30',
    }[props.color] || 'bg-stone-50 text-stone-600 shadow-md shadow-stone-300/30'
  )
})
</script>
