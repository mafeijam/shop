import { Swiper, SwiperSlide } from 'swiper/vue'
import 'swiper/css'
import 'swiper/css/pagination'
import 'swiper/css/effect-fade'

export default {
  install(app) {
    app.component('VueSwiper', Swiper)
    app.component('VueSwiperSlide', SwiperSlide)
  },
}
