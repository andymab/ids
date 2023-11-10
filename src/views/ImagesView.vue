<template>
  <full-image
    v-if="FullImage"
    :image="activeSrc"
    :title="activeTitle"
    @CloseFullImage="CloseFullImage"
  />
  <breadcrumbs-head :items="breadcrumbs" />
  <main>
    <v-container>
      <v-toolbar title="Фотоальбомы" density="compact">
        <v-text-field
          hide-details
          prepend-icon="mdi-magnify"
          single-line
          placeholder="...Найти"
        ></v-text-field>

        <v-tooltip location="top">
          <template v-slot:activator="{ props: tooltip }">
            <v-btn
              icon="mdi-newspaper-plus"
              v-bind="mergeProps(tooltip)"
              @click="showFilePreview = !showFilePreview"
            ></v-btn>
          </template>
          <span>Новый альбом</span>
        </v-tooltip>

        <v-switch
          v-model="showtooltype"
          hide-details
          inset
          compact
          label="Показать описания"
        ></v-switch>
      </v-toolbar>
      <div>
        <file-preview-dialog :dialog="showFilePreview" @onReset="showFilePreview = false" />
      </div>
      <v-virtual-scroll :items="items" height="dynamic">
        <template v-slot:default="{ item, index }">
          <div class="row">
            <div v-for="n in item" class="image-block" :key="index + '-' + n">
              <div class="image-content">
                <v-hover v-slot="{ isHovering, props }">
                    <div class="image-item" :key="index + '-image-item-' + n"
                    :class="{ 'active': isHovering || showtooltype}" v-bind="props"
                    >
                      <!-- <RouterLink to="/images/1"> -->
                      <v-img
                        :src="n.src_tmb"
                        :lazy-src="n.src_big"
                        cover
                        class="bg-grey-lighten-2 img-vue"
                        height="220"
                      >
                        <template v-slot:placeholder>
                          <v-row class="fill-height ma-0" center justify="center">
                            <v-progress-circular
                              indeterminate
                              color="grey-lighten-5"
                            ></v-progress-circular>
                          </v-row>
                        </template>

                        <v-toolbar density="compact">
                          <div class="d-flex px-2 image-toolbar">
                            <v-icon
                              icon="mdi-loupe"
                              @click="showFullImage"
                              :data-src="n.src_big"
                              :data-title="n.title"
                              :data-descr="n.descr"
                              class="mr-2"
                            ></v-icon>
                            <RouterLink to="/images/1">
                              <v-icon icon="mdi-exit-to-app"></v-icon>
                            </RouterLink>
                          </div>
                        </v-toolbar>

                        <div class="image-text-block" >
                          <h6>{{ n.title }} {{ n.descr }}</h6>
                        </div>
                      </v-img>
                    </div>
              
                </v-hover>
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

import FilePreviewDialog from '../components/Photo/FilePreviewDialog.vue'
import FullImage from '../components/Photo/FullImage.vue'

import json from '/src/assets/photo/albom.json'

export default {
  components: {
    FilePreviewDialog,
    FullImage
  },
  data: () => ({
    activeSrc: '',
    activeTitle: '',
    FullImage: false,
    showtitle: false,
    items: json,
    showFilePreview: false,
    showtooltype: false,
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
    mergeProps,
    CloseFullImage: function () {
      this.FullImage = false
      return false
    },
    showFullImage: function (e) {
      // console.log(e.target);
      console.log(e.target.dataset.src)
      this.activeSrc = e.target.dataset.src
      this.activeTitle = e.target.dataset.title
      this.FullImage = true
    }
    // addClass: function (e) {
    //  // if (e.target.classList.contains("has-children")) {
    //     e.target.classList.add("active");
    // // }
    // },
    // removeClass: function (e) {
    //   //if (e.target.classList.contains("has-children")) {
    //     e.target.classList.remove("active");
    // //  }
    // },
  }
}
</script>

<style>
.v-theme--light .image-item header {
  background-color: transparent;
  color: floralwhite;
}

.v-theme--light .image-item header a {
  color: floralwhite;
}

.image-toolbar {
  opacity: 0;
  transition: opacity 0.5s;

  align-items: center;
  width: 100%;
  justify-content: end;
}

.image-item.active .image-toolbar {
  opacity: 1;
}

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
  /* background-color: black; */
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

.image-block.active .image-text-block {
  display: block !important;
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
  bottom: 0;
  z-index: 2;
  font-size: 24px;
  opacity: 0;
  transition: opacity 0.5s;
}

.image-item.active .image-text-block {
  opacity: 0.6;
}



.image-item {
  opacity: 1;
  transition: all 0.5s;
  cursor: pointer;
}

.image-item:hover {
  opacity: 0.8;
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
