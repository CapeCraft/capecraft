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
    faAngleDown, faMoneyBillWave, faCopyright, faCircleNotch, faSmile, faFrown, faAngleLeft, faAngleRight,
    faCog, faTrash, faEraser, faIdBadge, faBold, faItalic, faStrikethrough, faUnderline, faParagraph, faListUl,
    faListOl, faUndo, faRedo, faTachometerAlt, faPencilAlt, faLink, faUnlink
} from '@fortawesome/free-solid-svg-icons'
library.add(
    faAngleDown, faMoneyBillWave, faCopyright, faCircleNotch, faSmile, faFrown, faAngleLeft, faAngleRight,
    faCog, faTrash, faEraser, faIdBadge, faBold, faItalic, faStrikethrough, faUnderline, faParagraph, faListUl,
    faListOl, faUndo, faRedo, faTachometerAlt, faPencilAlt, faLink, faUnlink
);

// Export
export { FontAwesomeIcon, FontAwesomeLayers };