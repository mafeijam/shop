<template>
  <Transition
    @before-enter="before"
    @before-leave="before"
    @after-enter="after"
    @after-leave="after"
    :name="name"
    mode="out-in"
  >
    <slot></slot>
  </Transition>
</template>

<script setup>
import { usePage } from '@inertiajs/inertia-vue3'

const page = usePage()

const name = computed(() => {
  if (page.props.value.last_url === page.url.value) {
    return 'none'
  }

  if (page.props.value.change_lang) {
    return 'none'
  }

  return 'page'
})

const before = () => {
  document.body.classList.add('overflow-hidden')
}

const after = () => {
  document.body.classList.remove('overflow-hidden')
}
</script>
