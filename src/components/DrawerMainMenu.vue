<template>
  <div>
    <v-navigation-drawer v-model="draweron" temporary>
      <v-list-item
        prepend-avatar="https://randomuser.me/api/portraits/men/78.jpg"
        title="John Leider"
      ></v-list-item>

      <v-divider></v-divider>

      <v-list density="compact" nav>
        <v-list-item prepend-icon="mdi-view-dashboard" title="Home" value="home"></v-list-item>
        <v-list-item prepend-icon="mdi-forum" title="About" value="about"></v-list-item>
      </v-list>
    </v-navigation-drawer>
  </div>
</template>

<script>
import { mergeProps } from 'vue'

export default {
  props: {
    drawer: {
      type: Boolean,
      default: () => 0
    }
  },
  data: () => ({
    draweron: null
  }),
  watch: {
    drawer: {
      handler(val) {
        this.draweron = val
      }
    }
  }
}
</script>
