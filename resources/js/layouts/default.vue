<template>
  <SiteHeader />

  <main class="prose h-full max-w-full flex-grow bg-stone-50 md:prose-lg">
    <PageTransition>
      <slot />
    </PageTransition>
  </main>

  <SiteFooter />
</template>

<script setup>
import PageTransition from '@/components/transition/PageTransition.vue'
</script>
