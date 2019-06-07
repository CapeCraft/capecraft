import Home from './views/Home'
import Rules from './views/Rules'
import AltRules from './views/AltRules'
import Staff from './views/Staff'
import Error from './views/Error'

const routes = [
  { path: '/', component: Home },
  { path: '/rules', component: Rules },
  { path: '/rules/alts', component: AltRules },
  { path: '/staff', component: Staff },
  { path: '*', component: Error },
]

export default routes;
