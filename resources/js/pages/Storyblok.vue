<template>
  <component
    :is="$getStoryComponent(storyData.content.component)"
    :blok="storyData.content"
  ></component>
</template>

<script setup>
import { useStoryblokBridge } from '@storyblok/vue'

const props = defineProps({
  story: {
    type: Object,
    default: Object,
  },
})

const storyData = ref(props.story)

onMounted(() => {
  useStoryblokBridge(storyData.value.id, story => (storyData.value = story))
})
</script>
