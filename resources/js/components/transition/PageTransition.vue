<template>
  <Transition
    name="page"
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
const before = () => {
  document.body.classList.add('overflow-hidden')
}

const after = () => {
  document.body.classList.remove('overflow-hidden')
}
</script>
