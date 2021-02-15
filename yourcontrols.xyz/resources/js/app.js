import { App, plugin } from '@inertiajs/inertia-vue'
import Vue from 'vue'
import { InertiaProgress } from '@inertiajs/progress'
import VueMeta from 'vue-meta'
import './bootstrap'

Vue.use(VueMeta)

InertiaProgress.init()
Vue.use(plugin)

const el = document.getElementById('app')

new Vue({
  metaInfo:{
    titleTemplate: '%s | YourControls'
  },
  render: h => h(App, {
    props: {
      initialPage: JSON.parse(el.dataset.page),
      resolveComponent: name => import(`./Pages/${name}`).then(module => module.default),
    },
  }),
}).$mount(el)