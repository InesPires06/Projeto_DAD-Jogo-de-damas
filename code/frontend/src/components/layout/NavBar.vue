<script setup>
import { Badge } from '@/components/ui/badge'
import {
  NavigationMenu,
  NavigationMenuContent,
  NavigationMenuItem,
  NavigationMenuLink,
  NavigationMenuList,
  NavigationMenuTrigger,
} from '@/components/ui/navigation-menu'
import { useAuthStore } from '@/stores/auth'

const authStore = useAuthStore()
</script>

<template>
  <header class="border-b bg-background">
    <nav class="mx-auto flex max-w-5xl flex-wrap items-center gap-x-6 gap-y-2 px-4 py-3">
      <!-- Título / Logo do Jogo -->
      <RouterLink to="/" class="text-lg font-bold text-amber-600 dark:text-amber-400">
        Jogo de Damas
      </RouterLink>

      <!-- Links Principais da Plataforma -->
      <div class="flex items-center space-x-4">
        <RouterLink to="/lobby" class="text-sm font-medium hover:underline"> Lobby </RouterLink>
        <RouterLink to="/wallet" class="text-sm font-medium hover:underline"> Carteira </RouterLink>
        <RouterLink to="/profile" class="text-sm font-medium hover:underline"> Perfil </RouterLink>
      </div>

      <!-- Menu Dropdown para as Páginas de Teste da Entrega Intermédia -->
      <NavigationMenu>
        <NavigationMenuList>
          <NavigationMenuItem>
            <NavigationMenuTrigger class="h-8 text-xs">Testes</NavigationMenuTrigger>
            <NavigationMenuContent>
              <ul class="w-44 p-2">
                <li>
                  <NavigationMenuLink as-child>
                    <RouterLink to="/laravel" class="block p-2 text-sm hover:bg-accent rounded">
                      Laravel Test
                    </RouterLink>
                  </NavigationMenuLink>
                </li>
                <li>
                  <NavigationMenuLink as-child>
                    <RouterLink to="/websockets" class="block p-2 text-sm hover:bg-accent rounded">
                      WebSockets Test
                    </RouterLink>
                  </NavigationMenuLink>
                </li>
              </ul>
            </NavigationMenuContent>
          </NavigationMenuItem>
        </NavigationMenuList>
      </NavigationMenu>

      <!-- Área de Autenticação / Perfil do Utilizador -->
      <div class="ml-auto flex items-center space-x-3">
        <template v-if="authStore.isLoggedIn">
          <Badge variant="default">
            {{ authStore.user?.name || 'Jogador' }}
          </Badge>
        </template>

        <template v-else>
          <RouterLink to="/login" class="text-sm font-medium hover:underline"> Entrar </RouterLink>
          <RouterLink
            to="/register"
            class="text-sm font-medium px-3 py-1.5 rounded bg-primary text-primary-foreground hover:bg-primary/90 transition-colors"
          >
            Registar
          </RouterLink>
        </template>
      </div>
    </nav>
  </header>
</template>
