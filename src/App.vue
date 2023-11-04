<script setup>
import { RouterLink, RouterView } from 'vue-router'
// import HelloWorld from './components/HelloWorld.vue'
// import DrawerMainMenu from './components/DrawerMainMenu.vue'
</script>

<template>
  <v-app>
    <!-- <drawer-main-menu :drawer="drawer"/> -->

    <v-navigation-drawer v-model="drawer" temporary>
      <v-list-item
        prepend-avatar="https://randomuser.me/api/portraits/men/78.jpg"
        title="John Leider"
      ></v-list-item>

      <v-divider></v-divider>

      <v-list density="compact" nav>
        <v-list-item v-for="(item, index) in items" :key="index" :value="index">
          <RouterLink :to="item.link" class="router-menu">
            <div class="d-flex align-center">
              <v-icon :icon="item.icon" />
              <v-list-item-title>
                {{ item.title }}
              </v-list-item-title>
            </div>
          </RouterLink>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar color="primary" density="compact">
      <template v-slot:prepend>
        <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
      </template>
      <v-app-bar-title>Иванкин Денис Сергеевич</v-app-bar-title>

      <v-menu>
        <template v-slot:activator="{ props: menu }">
          <v-tooltip location="top">
            <template v-slot:activator="{ props: tooltip }">
              <v-btn icon="mdi-dots-vertical" v-bind="mergeProps(menu, tooltip)"></v-btn>
            </template>
            <span>Дополнительные действия</span>
          </v-tooltip>
        </template>
        <v-list density="compact" nav>
          <v-list-item v-for="(item, index) in items" :key="index" :value="index">
            <RouterLink :to="item.link" class="router-menu">
              <div class="d-flex align-center">
                <v-icon :icon="item.icon" />
                <v-list-item-title>
                  {{ item.title }}
                </v-list-item-title>
              </div>
            </RouterLink>
          </v-list-item>
        </v-list>
      </v-menu>
    </v-app-bar>
      <RouterView />
  </v-app>
</template>

<script>
import { mergeProps } from 'vue'

export default {
  components: {
    // DrawerMainMenu
  },
  data: () => ({
    drawer: null,
    items: [
      {
        icon: 'mdi-view-dashboard',
        title: 'Home',
        link: '/'
      },

      {
        icon: 'mdi-post',
        title: 'blog',
        link: '/blog'
      },
      {
        icon: 'mdi-forum',
        title: 'О компании',
        link: '/about'
      },
      {
        icon: 'mdi-logout',
        title: 'Войти',
        link: '/login'
      }
    ]
  }),
  methods: {
    mergeProps
  }
}
</script>

<style scoped>
.router-menu {
  display: block;
  text-decoration: none;

  padding: 0;
}
.router-menu .v-list-item-title {
  margin-left: 8px;
  color: dimgrey;
  font-family: Roboto;
  font-weight: 500;
  text-transform: uppercase;
}

</style>
