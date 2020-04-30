import Vue from 'vue'
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

// import { } from '@fortawesome/free-regular-svg-icons'

import {
  faBook, faUser, faLock, faSignOutAlt, faCog, faDownload, faHome, faHeart, faNewspaper, faGlobe, faShieldAlt, faPlus, faCrown, faStar, faBan, faHandshake, faUserCircle, faUserPlus, faTachometerAlt
} from '@fortawesome/free-solid-svg-icons'

import {
  faGithub, faSlack, faSlackHash
} from '@fortawesome/free-brands-svg-icons'

library.add(
  faBook, faUser, faLock, faSignOutAlt, faCog, faDownload, faGithub, faHome, faHeart, faNewspaper, faGlobe, faShieldAlt, faSlack, faSlackHash, faPlus, faCrown, faStar, faBan, faHandshake, faUserCircle, faUserPlus, faTachometerAlt
)

Vue.component('fa', FontAwesomeIcon)
