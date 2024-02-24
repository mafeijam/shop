<template>
  <div class="container mx-auto px-6 py-8">
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
      <div v-for="i in 9" :key="i" class="rounded border border-stone-200/70 bg-white">
        <SiteProductCard :burger="i" />
      </div>
    </div>
  </div>
</template>
