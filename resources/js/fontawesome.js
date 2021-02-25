// Vue font awesome
import { FontAwesomeIcon, FontAwesomeLayers } from '@fortawesome/vue-fontawesome'
import { library } from '@fortawesome/fontawesome-svg-core'

// Brands
import {
    faDiscord
} from '@fortawesome/free-brands-svg-icons';
library.add(faDiscord);

// Solid
import {
    faAngleDown, faMoneyBillWave, faCopyright, faCircleNotch, faSmile, faFrown
} from '@fortawesome/free-solid-svg-icons'
library.add(faAngleDown, faMoneyBillWave, faCopyright, faCircleNotch, faSmile, faFrown);

// Regular
// import { faCopyright } from '@fortawesome/free-regular-svg-icons';
// library.add(faCopyright);

// Export
export { FontAwesomeIcon, FontAwesomeLayers };