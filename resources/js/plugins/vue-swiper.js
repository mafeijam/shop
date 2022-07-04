import { Swiper, SwiperSlide } from 'swiper/vue'
import 'swiper/css'

export default {
  install(app) {
    app.component('VueSwiper', Swiper)
    app.component('VueSwiperSlide', SwiperSlide)
  },
}
