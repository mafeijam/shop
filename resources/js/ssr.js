import { createSSRApp, h } from 'vue'
import { renderToString } from '@vue/server-renderer'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import createServer from '@inertiajs/server'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import envPlugin from '@/plugins/env'
import autoload from '@/plugins/autoload'
import inertiaSetting from '@/plugins/inertia-setting'
import vueSwiper from '@/plugins/vue-swiper'
import imgix from '@/plugins/imgix'
import storyblok from '@/plugins/storyblok'
import layout from '@/layouts/default.vue'

import '../css/app.css'

const pages = import.meta.globEager('./pages/**/*.vue')

createServer(page =>
  createInertiaApp({
    page,
    render: renderToString,
    resolve: async name => {
      const comp = (await resolvePageComponent(`./pages/${name}.vue`, pages)).default
      comp.layout ??= layout
      return comp
    },
    setup({ app, props, plugin }) {
      return createSSRApp({ render: () => h(app, props) })
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
