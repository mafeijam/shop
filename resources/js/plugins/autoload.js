import { upperFirst } from 'lodash'

export default {
  install(app, options) {
    for (let l of options.list) {
      Object.entries(l.components).forEach(([path, c]) => {
        const file = path.split('/').pop().replace('.vue', '')
        const comp = c.default
        comp.name = `${l.prefix}${file}`
        app.component(comp.name, comp)
      })
    }

    app.config.globalProperties.$getStoryComponent = name => `Story${upperFirst(name)}`
  },
}
