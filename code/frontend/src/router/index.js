import { createRouter, createWebHistory } from 'vue-router'

//paginas que criamos src/pages/
import LobbyPage from '@/pages/LobbyPage.vue'
import GamePage from '@/pages/GamePage.vue'
import ProfilePage from '@/pages/ProfilePage.vue'
import WalletPage from '@/pages/WalletPage.vue'

//paginas que criamos src/pages/auth
import LoginPage from '@/pages/auth/LoginPage.vue'
import RegisterPage from '@/pages/auth/RegisterPage.vue'

//paginas ja criadas na entrega intermedia
//import LaravelPage from '@/pages/laravel/LaravelPage.vue'
//import WebsocketsPage from '@/pages/websockets/WebsocketsPage.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    // Se o utilizador aceder a '/', vai para o Lobby
    {
      path: '/',
      redirect: '/lobby',
    },
    {
      path: '/lobby',
      name: 'lobby',
      component: LobbyPage,
    },
    {
      path: '/login',
      name: 'login',
      component: LoginPage,
    },
    {
      path: '/register',
      name: 'register',
      component: RegisterPage,
    },
    {
      path: '/game/:id', // O ':id' permite passar o ID da partida (ex: /game/12)
      name: 'game',
      component: GamePage,
      props: true,
    },
    {
      path: '/profile',
      name: 'profile',
      component: ProfilePage,
    },
    {
      path: '/wallet',
      name: 'wallet',
      component: WalletPage,
    },
  ],
})

export default router
