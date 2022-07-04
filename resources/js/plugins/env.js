export default {
  install(app) {
    app.config.globalProperties.$isLocal = import.meta.env.MIX_APP_ENV === 'local'

    app.config.globalProperties.$isProd = import.meta.env.MIX_APP_ENV === 'production'
  },
}
