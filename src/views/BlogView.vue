<template>
  <breadcrumbs-head :items="items" />
  <main>
    <v-container>
      <div class="about">
        <h1>Blog</h1>
      </div>
    </v-container>
  </main>
</template>

<script>
export default {
  data: () => ({
    drawer: null,
    items: [
      {
        icon: 'mdi-view-dashboard',
        title: 'Home',
        to: '/'
      },

      {
        icon: 'mdi-post',
        title: 'blog',
        to: ''
      },
    ]
  }
  )
}

</script>

<style>
/* @media (min-width: 1024px) {
  .about {
    min-height: 90vh;
    display: flex;
    align-items: center;
  }
} */
</style>
