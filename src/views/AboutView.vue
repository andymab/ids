<template>
  <breadcrumbs-head :items="items" />
  <main>
    <v-container>
      <div class="about">
        <h1>This is an about page</h1>
      </div>
    </v-container>
  </main>
</template>

<script>
export default {
  data: () => ({
    items: [
      {
        icon: 'mdi-view-dashboard',
        title: 'Home',
        to: '/'
      },
      {
        icon: 'mdi-forum',
        title: 'О компании',
        link: ''
      },
    ]
  })
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
