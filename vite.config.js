import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'
import AutoImport from 'unplugin-auto-import/vite'
import Icons from 'unplugin-icons/vite'
import Components from 'unplugin-vue-components/vite'
import IconsResolver from 'unplugin-icons/resolver'

export default defineConfig({
  server: {
    host: '192.168.50.52',
    hmr: {
      host: '192.168.50.52',
      port: 6060,
    },
  },
  ssr: {
    noExternal: ['swiper'],
  },
  plugins: [
    laravel({
      input: 'resources/js/app.js',
      ssr: 'resources/js/ssr.js',
    }),

    vue({
      template: {
        transformAssetUrls: {
          base: null,
          includeAbsolute: false,
        },
        // compilerOptions: {
        //   isCustomElement: tag => ['ix-img'].includes(tag),
        // },
      },
    }),

    AutoImport({
      imports: ['vue'],
      eslintrc: {
        enabled: true,
      },
      dts: true,
    }),

    Icons({
      autoInstall: true,
    }),

    Components({
      resolvers: [
        IconsResolver({
          prefix: 'i',
        }),
      ],
    }),
  ],
})
