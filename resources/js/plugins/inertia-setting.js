import { Link, usePage, router } from '@inertiajs/vue3'
import { show as showMobileMenu } from '@/composable/useMobileMenu'

const getUrlWithLang = (path, page) => {
  return [page.props.domain, page.props.current_lang, path]
    .filter(v => !!v)
    .join('/')
    .replace(/\/+$/, '')
}

const isLinkActive = (path, page) => {
  if (path.endsWith('/')) {
    path = path.slice(0, -1)
  }

  const link = [page.props.current_lang, path].filter(v => !!v).join('/')

  return `/${link}` === page.url
}

if (typeof window !== 'undefined') {
  router.on('before', event => {
    const page = usePage()
    return event.detail.visit.url.pathname !== page.url
  })

  router.on('navigate', event => {
    showMobileMenu.value = false

    if (event.detail.page.props.is_public) {
      gtag('event', 'page_view', {
        page_location: event.detail.page.url,
      })
    }
  })
}

export default {
  install(app) {
    app.component('InertiaLink', Link)

    app.config.globalProperties.$getUrlWithLang = getUrlWithLang

    app.config.globalProperties.$isLinkActive = isLinkActive
  },
}
