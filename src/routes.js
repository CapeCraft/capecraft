import Home from './views/Home'
import Staff from './views/Staff'
import Error from './views/Error'

const routes = [
  { path: '/', component: Home },
  { path: '/staff', component: Staff },
  { path: '*', component: Error },
]

export default routes;
