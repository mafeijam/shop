import upperFirst from 'lodash/upperFirst'

const list = [
  {
    components: import.meta.globEager('../components/storyblok/*.vue'),
    prefix: 'Story',
  },
  {
    components: import.meta.globEager('../components/site/*.vue'),
    prefix: 'Site',
  },
]

export default {
  install(app) {
    for (let l of list) {
      Object.entries(l.components).forEach(([path, c]) => {
        const file = path.split('/').pop().replace('.vue', '')
        const comp = c.default
        comp.name = `${l.prefix}${file}`
        app.component(comp.name, comp)
      })
    }

    app.config.globalProperties.$sb = name => `Story${upperFirst(name)}`
  },
}
