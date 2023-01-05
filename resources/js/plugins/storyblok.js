import { StoryblokVue, apiPlugin } from '@storyblok/vue'

export default {
  install(app) {
    app.use(StoryblokVue, {
      accessToken: import.meta.env.VITE_STORYBLOK,
      bridge: import.meta.env.VITE_APP_ENV !== 'production',
      use: [apiPlugin],
    })
  },
}
