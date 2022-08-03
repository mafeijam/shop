<template>
  <Transition
    :name="name"
    mode="out-in"
    @before-enter="before"
    @before-leave="before"
    @after-enter="after"
    @after-leave="after"
  >
    <slot />
  </Transition>
</template>

<script setup>
import { usePage } from '@inertiajs/inertia-vue3'

const page = usePage()

const unchaged = computed(
  () => page.props.value.last_url === page.url.value || page.props.value.change_lang
)

const name = computed(() => {
  if (unchaged.value) {
    return 'none'
  }

  return 'page'
})

const before = () => {
  if (unchaged.value) {
    return
  }

  document.body.classList.add('overflow-hidden')
}

const after = () => {
  if (unchaged.value) {
    return
  }

  document.body.classList.remove('overflow-hidden')
}
</script>
