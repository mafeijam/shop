<template>
  <SiteHeader />

  <main class="prose h-full max-w-none flex-grow bg-stone-50 md:prose-lg">
    <PageTransition>
      <slot></slot>
    </PageTransition>
  </main>

  <SiteFooter />
</template>

<script setup>
import PageTransition from '@/components/transition/PageTransition.vue'
</script>
