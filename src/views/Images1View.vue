<template>
    <breadcrumbs-head :items="breadcrumbs" />
    <main>
      <v-container>
        <v-virtual-scroll :items="items" height="dynamic">
          <template v-slot:default="{ item, index }">
            <div class="row">
              <div v-for="n in item" class="image-block">
                <div class="image-content">
                  <div class="image-text-block" v-show="showtooltype">
                    <h6>{{ n.title }}</h6>
                  </div>
                  <div class="image-item">
  
                    <RouterLink to="/images/1">
                      <v-img :src="n.src" :lazy-src="n.src" contain class="bg-grey-lighten-2">
                        <template v-slot:placeholder>
                          <v-row class="fill-height ma-0" align="center" justify="center">
                            <v-progress-circular indeterminate color="grey-lighten-5"></v-progress-circular>
                          </v-row>
                        </template>
                      </v-img>
                    </RouterLink>
                  </div>
                </div>
              </div>
            </div>

          </template>
        </v-virtual-scroll>
      </v-container>
    </main>
  </template>
  
  <script>
  import json from '/src/assets/photo/albom.json'

  export default {
    data: () => ({
      items: json,
      breadcrumbs: [
        {
          icon: 'mdi-view-dashboard',
          title: 'Home',
          to: '/'
        },
        {
          icon: 'mdi-imagesmode',
          title: 'Фото Альбомы',
          to: '/images'
        },
        {
          icon: 'mdi-imagesmode',
          title: 'Семейный фотоальбом',
          to: ''
        },
      ]
    }),

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
  