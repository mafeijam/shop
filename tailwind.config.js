/* eslint-disable */
// prettier-ignore

module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.vue',
    './resources/**/*.js'
  ],
  safelist: [{
    pattern: /(.+)-(enter|leave)-(.+)|swiper-btn-(.+)/
  }],
  theme: {
    extend: {
      screens: {
        '2xl': '1440px'
      }
    },
  },
  plugins: [
    require('@tailwindcss/typography')
  ],
}
