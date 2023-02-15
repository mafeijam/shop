import { createSSRApp, h } from 'vue'
import { renderToString } from '@vue/server-renderer'
import { createInertiaApp } from '@inertiajs/vue3'
import createServer from '@inertiajs/vue3/server'
import envPlugin from '@/plugins/env'
import autoload from '@/plugins/autoload'
import inertiaSetting from '@/plugins/inertia-setting'
import vueSwiper from '@/plugins/vue-swiper'
import imgix from '@/plugins/imgix'
import storyblok from '@/plugins/storyblok'
import layout from '@/layouts/default.vue'

import '../css/app.css'

createServer(page =>
  createInertiaApp({
    page,
    render: renderToString,
    resolve: name => {
      const pages = import.meta.glob('./pages/**/*.vue', { eager: true })
      let page = pages[`./pages/${name}.vue`]
      page.default.layout ??= layout
      return page
    },
    setup({ App, props, plugin }) {
      return createSSRApp({ render: () => h(App, props) })
        .use(plugin)
        .use(envPlugin)
        .use(vueSwiper)
        .use(imgix)
        .use(inertiaSetting)
        .use(autoload)
        .use(storyblok)
    },
  })
)
