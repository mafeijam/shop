import { createApp, h } from 'vue'
import { createInertiaApp, usePage } from '@inertiajs/vue3'
import envPlugin from '@/plugins/env'
import autoload from '@/plugins/autoload'
import inertiaSetting from '@/plugins/inertia-setting'
import vueSwiper from '@/plugins/vue-swiper'
import imgix from '@/plugins/imgix'
import storyblok from '@/plugins/storyblok'
import layout from '@/layouts/default.vue'

import '../css/app.css'

createInertiaApp({
  progress: {
    delay: 350,
    color: '#60a5fa',
    includeCSS: true,
    showSpinner: false,
  },
  resolve: name => {
    const pages = import.meta.glob('./pages/**/*.vue', { eager: true })
    let page = pages[`./pages/${name}.vue`]
    page.default.layout ??= layout
    return page
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(envPlugin)
      .use(vueSwiper)
      .use(imgix)
      .use(inertiaSetting)
      .use(autoload)
      .use(storyblok)
      .mount(el)
  },
})
