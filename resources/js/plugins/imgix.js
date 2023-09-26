import VueImgix, { IxImg } from '@imgix/vue'

export default {
  install(app) {
    app.use(VueImgix, {
      domain: 'jw-assets.imgix.net',
      defaultIxParams: {
        auto: 'format,compress',
      },
      includeLibraryParam: false,
    })

    app.component('IxImg', IxImg)
  },
}
