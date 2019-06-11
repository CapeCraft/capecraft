import Home from './views/Home'
import Rules from './views/Rules'
import AltRules from './views/AltRules'
import Unban from './views/Unban'
import Staff from './views/Staff'
import Error from './views/Error'

const routes = [
  { path: '/', component: Home },
  { path: '/rules', component: Rules },
  { path: '/rules/alts', component: AltRules },
  { path: '/unban', component: Unban },
  { path: '/staff', component: Staff },
  { path: '*', component: Error },
]

export default routes;
