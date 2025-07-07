import { defaultConfig } from '@formkit/vue'
import { rootClasses } from './formkit.theme'
import {applicationIcons, genesisIcons, radio} from '@formkit/icons'
import {pt} from '@formkit/i18n'
import { createMultiStepPlugin } from '@formkit/addons'

export default defaultConfig({
  locales:{pt},
  locale: 'pt',
  icons:{
    ...applicationIcons,
    ...genesisIcons
  },
  config: {
    rootClasses
  },
  plugins: [createMultiStepPlugin()
  ]

})