<template>
  <breadcrumbs-head :items="breadcrumbs" />
  <main>
    <v-container>
      <v-virtual-scroll :items="items" height="400">
        <template v-slot:default="{ item, index }">
          <div v-for="n in item" class="image-block">
            <div class="image-text-block">
                <h6>Семейный Альбом</h6>
            </div>
            <div class="image-item">
                <RouterLink to="/images/1">
              <v-img
                :src="`https://picsum.photos/500/300?image=${n * 5 + 10}`"
                :lazy-src="`https://picsum.photos/10/6?image=${n * 5 + 10}`"
                cover
                class="bg-grey-lighten-2"
              >
                <template v-slot:placeholder>
                  <v-row class="fill-height ma-0" align="center" justify="center">
                    <v-progress-circular indeterminate color="grey-lighten-5"></v-progress-circular>
                  </v-row>
                </template>
              </v-img>
            </RouterLink>
            </div>
          </div>
        </template>
      </v-virtual-scroll>
    </v-container>
  </main>
</template>

<script>
export default {
  data: () => ({
    breadcrumbs: [
      {
        icon: 'mdi-view-dashboard',
        title: 'Home',
        to: '/'
      },
      {
        icon: 'mdi-forum',
        title: 'Фото Альбомы',
        link: ''
      }
    ]
  }),
  computed: {
    items() {
      return [
        [1, 2, 3],
        [4, 5, 6],
        [7, 8, 9],
        [10, 11, 12],
        [13, 14, 15]
      ]
    }

    //     return Array.from({ length: 1000 }, (k, v) => v + 1)
    //   },
  }
}
</script>

<style>
.v-virtual-scroll__item {
  display: flex;
  justify-content: center;
}
.image-block {
  position: relative;
  padding: 4px;
}

.image-text-block{
    font-family: Roboto;
    width: 250px;
    text-align: center;
    opacity: 0.7;
    background-color: rgb(243, 243, 243);
    /* padding: 14px; */
    position: absolute;
    bottom:4px;
    /* left:14px; */
    z-index: 2;
    font-size: 24px;
}
.image-item {
  opacity: 0.4;
  transition: all 0.5s;
  height: 150px;
  width: 250px;
  cursor: pointer;
}

.image-item:hover{
    opacity: 1;
}
 
</style>
