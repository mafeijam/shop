import { InertiaProgress } from '@inertiajs/progress'
import { Link, usePage } from '@inertiajs/inertia-vue3'

export default {
  install(app, options) {
    if (!options.ssr) {
      InertiaProgress.init({
        delay: 350,
        color: '#60a5fa',
        includeCSS: true,
        showSpinner: false,
      })
    }

    const page = usePage()

    app.component('InertiaLink', Link)

    app.config.globalProperties.$getLang = path =>
      page.props.value.current_lang === null
        ? `${page.props.value.domain}/${path}`
        : `${page.props.value.domain}/${page.props.value.current_lang}/${path}`
  },
}
