import Vue from 'vue'
import Vuetify from 'vuetify'

const v = window.location.pathname.substring(0, 12) == "/member-area" ? true : false
if (v) {
  import('vuetify/dist/vuetify.min.css')
}

Vue.use(Vuetify)

const opts = {}

export default new Vuetify(opts)