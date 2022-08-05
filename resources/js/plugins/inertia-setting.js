import { Inertia } from '@inertiajs/inertia'
import { InertiaProgress } from '@inertiajs/progress'
import { Link, usePage } from '@inertiajs/inertia-vue3'

const page = usePage()

const getUrlWithLang = path => {
  return [page.props.value.domain, page.props.value.current_lang, path]
    .filter(v => !!v)
    .join('/')
    .replace(/\/+$/, '')
}

const isLinkActive = path => {
  if (path.endsWith('/')) {
    path = path.slice(0, -1)
  }

  const link = [page.props.value.current_lang, path].filter(v => !!v).join('/')

  return `/${link}` === page.url.value
}

if (typeof window !== 'undefined') {
  InertiaProgress.init({
    delay: 350,
    color: '#60a5fa',
    includeCSS: true,
    showSpinner: false,
  })

  Inertia.on('before', event => {
    return event.detail.visit.url.pathname !== page.url.value
  })
}

export default {
  install(app) {
    app.component('InertiaLink', Link)

    app.config.globalProperties.$getUrlWithLang = getUrlWithLang

    app.config.globalProperties.$isLinkActive = isLinkActive
  },
}
