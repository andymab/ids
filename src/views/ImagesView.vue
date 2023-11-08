<template>
  <breadcrumbs-head :items="breadcrumbs" />
  <main>
    <v-container>
      <v-toolbar title="Фотоальбомы" density="compact">

        <v-text-field hide-details prepend-icon="mdi-magnify" single-line placeholder="...Найти"></v-text-field>

        <v-tooltip location="top">
          <template v-slot:activator="{ props: tooltip }">
            <v-btn icon="mdi-newspaper-plus" v-bind="mergeProps(tooltip)" @click="showFilePreview = !showFilePreview"></v-btn>
          </template>
          <span>Новый альбом</span>
        </v-tooltip>

    
          <v-switch v-model="showtooltype" hide-details inset compact label="Показать описания"></v-switch>
      </v-toolbar>
      <div>
      <file-preview :dialog="showFilePreview"/>
    </div>
      <v-virtual-scroll :items="items" height="dynamic">
        <template v-slot:default="{ item }">
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

import { mergeProps } from 'vue'

import FilePreview from '../components/Photo/FilePreview.vue' 


import json from '/src/assets/photo/albom.json'

export default {
  components:{
    FilePreview
  },
  data: () => ({
    items: json,
    showFilePreview:false,
    showtooltype:false,
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
  methods: {
    mergeProps
  },

}
</script>

<style>
.v-virtual-scroll__item {
  /* display: flex; */
  /* justify-content: center; */
}

.row {
  display: flex;
  flex-wrap: wrap;
  padding: 0 4px;
}

.image-block {
  position: relative;
  flex: 25%;
  max-width: 25%;
  padding: 0 4px;
  background-color: black;
  text-align: center;
}

.image-content {
  display: block;
  position: relative;
  padding: 4px 0;
}

.image-item {
  margin-top: 8px;
  vertical-align: middle;
  width: 100%;

}

/* .image-block {

} */
/* .image-block:hover .image-text-block {
  opacity: 0.7;
} */

.image-text-block {
  width: 100%;
  font-family: Roboto;
  text-align: center;
  color: white;
  opacity: 0.7;
  background-color: rgb(19, 18, 18);
  position: absolute;
  bottom: 4px;
  z-index: 2;
  font-size: 24px;
}

.image-item {
  opacity: 1;
  transition: all 0.5s;
  cursor: pointer;
}

.image-item:hover {
  opacity: 0.7;
}

/* Responsive layout - makes a two column-layout instead of four columns */
@media screen and (max-width: 800px) {
  .image-block {
    flex: 50%;
    max-width: 50%;
  }
}

/* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .image-block {
    flex: 100%;
    max-width: 100%;
  }
}
</style>
