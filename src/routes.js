import Home from './views/Home'
import Staff from './views/Staff'
import Error from './views/Error'

const routes = [
  { path: '/', component: Home },
  { path: '/staff', component: Staff },
  { path: '/merch', beforeEnter() { location.href = 'https://shop.spreadshirt.co.uk/capecraft/all' } },
  { path: '/donate', beforeEnter() { location.href = 'https://capecraftserver.buycraft.net/' } },
  { path: '/discord', beforeEnter() { location.href = 'https://discord.gg/62MCajz' } },
  { path: '*', component: Error },
]

export default routes;
