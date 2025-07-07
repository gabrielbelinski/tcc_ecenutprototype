import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'

import '../css/app.css'
import { defaultConfig, plugin as formKitPlugin } from '@formkit/vue'
import formKitConfig from '../../formkit.config.js'
import naive from 'naive-ui'
import 'vfonts/Lato.css'
import 'vfonts/FiraCode.css'



createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    return pages[`./Pages/${name}.vue`]
  },
  setup({ el, App, props, plugin: inertiaPlugin }) {
    createApp({ render: () => h(App, props) })
      .use(inertiaPlugin).use(formKitPlugin, defaultConfig(formKitConfig)).use(naive)
      .mount(el)
  },
})
