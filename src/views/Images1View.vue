<template>
  <slaider-photo v-if="SliderShow" :images="getItems()" :curitem="activeSrc" @CloseSlaider="SliderShow = !SliderShow"/>
  <full-image v-if="FullImage" :image="FullImageSrc" :title="activeTitle" @CloseFullImage="CloseFullImage" />
  <div v-show="!FullImage && !SliderShow">
  <app-bar />
  <breadcrumbs-head :items="breadcrumbs" />
  <main v-show="!FullImage">
    <v-container>
      <v-toolbar :title="toolbartitle" density="compact">
        <v-text-field hide-details prepend-icon="mdi-magnify" single-line placeholder="...Найти"></v-text-field>

        <v-tooltip location="top">
          <template v-slot:activator="{ props: tooltip }">
            <v-btn icon="mdi-newspaper-plus" v-bind="mergeProps(tooltip)"
              @click="showFilePreview = !showFilePreview"></v-btn>
          </template>
          <span>Новое фото</span>
        </v-tooltip>

        <v-tooltip location="top">
          <template v-slot:activator="{ props: tooltip }">
            <v-btn icon="mdi-image-move" v-bind="mergeProps(tooltip)"
              @click="SliderShow = !SliderShow"></v-btn>
          </template>
          <span>Slaider</span>
        </v-tooltip>

        <v-switch v-model="showtooltype" hide-details inset compact label="Показать описания"></v-switch>
      </v-toolbar>
      <div>
        <file-preview-dialog :dialog="showFilePreview"  :id="1" :photo_id="1" :srcpreview="activeSrc" @onReset="showFilePreview = false" />
      </div>
      <v-virtual-scroll :items="items" height="dynamic">
        <template v-slot:default="{ item, index }">
          <div class="row">
            <div v-for="n in item" class="image-block" :key="index + '-' + n">
              <div class="image-content">
                <v-hover v-slot="{ isHovering, props }">
                  <v-card :elevation="isHovering ? 4 : 2" v-bind="props">
                    <div class="image-item" :key="index + '-image-item-' + n"
                      :class="{ 'active': isHovering || showtooltype }" v-bind="props">
                      <!-- <RouterLink to="/images/1"> -->
                      <v-img :src="n.src_tmb" :lazy-src="n.src_big" cover class="bg-grey-lighten-2 img-vue" height="220" >
                        <template v-slot:placeholder>
                          <v-row class="fill-height ma-0 " align="center" justify="center">
                            <v-progress-circular indeterminate color="grey-lighten-5"></v-progress-circular>
                          </v-row>
                        </template>

                        <template v-slot:error>
                          <v-img class="mx-auto" height="220" max-width="500" cover
                            src="/public/default.jpg"></v-img>
                        </template>

                        <v-toolbar density="compact">
                          <div class="d-flex px-2 image-toolbar">
                            <v-icon icon="mdi-loupe" @click="showFullImage(n.src_big,n.title,n.descr)" class="mr-2"></v-icon>
                            <v-icon icon="mdi-newspaper" @click="showFilePreviewDialog(n.src_tmb)" class="mr-2"></v-icon>
</div>

                        </v-toolbar>

                        <div class="image-text-block">
                          <h6>{{ n.title }} {{ n.descr }}</h6>
                        </div>
                      </v-img>
                    </div>
                  </v-card>
                </v-hover>
              </div>
            </div>
          </div>
        </template>
      </v-virtual-scroll>
    </v-container>
  </main>
  </div>
</template>

<script>
import { mergeProps } from 'vue'

import FilePreviewDialog from '../components/Photo/FilePreviewDialog.vue'
import FullImage from '../components/Photo/FullImage.vue'


import json from '/src/assets/photo/001.json'
import SlaiderPhoto from '../components/Photo/SlaiderPhoto.vue'

export default {
  components: {
    FilePreviewDialog,
    FullImage,
    SlaiderPhoto
  },
  data: () => ({
    SliderShow:false,
    toolbartitle: json[0].title ?? "",
    activeSrc: '',
    activeTitle: '',
    FullImage: false,
    FullImageSrc: '',
    showtitle: false,
    items: json[0][0].source,
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
        to: '/images'
      },
      {
        icon: 'mdi-forum',
        title: 'г Надежда 2023',
        to: ''
      }

    ]
  }),
  created(){
    console.log(this.json)
  },
  mounted(){
     console.log(this.json)
  },
  methods: {
    mergeProps,
    showFilePreviewDialog:function(src){
      this.activeSrc = src;
      this.showFilePreview = !this.showFilePreview;
    },
    CloseFullImage: function () {
      this.FullImage = false    
      return false
    },
    showFullImage: function (src,title,descr) {
      this.FullImageSrc = src
      this.activeTitle = title + descr
      this.FullImage = true
    },
    getItems: function(){
      return this.items[0];
    },
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
  text-align: center;
}

.image-content {
  display: block;
  position: relative;
  padding: 4px 0;
}

.image-item {
  vertical-align: middle;
  width: 100%;
}

.image-block.active .image-text-block {
  display: block !important;
}

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
