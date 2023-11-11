
<script setup>
  import TheWelcome from '../components/TheWelcome.vue'
</script>

<template>
  <app-bar />
  <breadcrumbs-head :items="items" />
  <main>
    <v-container>
      <TheWelcome />
    </v-container>
  </main>
</template>

<script >

export default {
  data: () => ({
    items: [
      {
        icon: 'mdi-view-dashboard',
        title: 'Home',
        to: ''
      }
    ]
  })
}
</script>
