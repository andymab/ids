<template>
  <v-dialog v-model="showPreview" width="auto">
    <v-card>
      <v-card-title class="d-flex justify-space-between align-center">
        <span> File Upload Preview.</span>

        <v-btn icon="$close" @click="closeDialog"> </v-btn>
      </v-card-title>
      <v-card-text>
        <div class="d-flex flex-column justify-center align-center fill-height">
          <input
            ref="filePickerField"
            type="file"
            accept="image/*"
            @change="launchCropper"
            hidden
          />

          <div style="height: 350px; width: 350px; border: 2px solid black">
            <!-- <v-avatar size="350px" class="mt-5" style="border: 2px solid black;"> -->
            <v-img :src="avatarImage" @click="uploadBlob(avatarImage)" class="avatar-image"></v-img>
            <!-- </v-avatar> -->
          </div>
          <v-container fluid class="px-0">
            <v-text-field clearable label="Наименование" v-model="photo.title"></v-text-field>
            <v-textarea
              label="Описание"
              ref="descr"
              v-model="photo.descr"
              auto-grow
              :rules="rules"
              rows="2"
            ></v-textarea>

            <v-btn class="mr-2" @click="$refs.filePickerField.click()"> Загрузить </v-btn>
            <v-btn class="" @click="submitFile()"> Save php </v-btn>
          </v-container>
          <image-cropper-dialog
            ref="cropperDialog"
            :chosenImage="chosenImage"
            @onReset="$refs.filePickerField.value = null"
            @onCrop="
              (croppedImage) => {
                avatarImage = croppedImage
              }
            "
          />
        </div>
        <!-- <img v-bind:src="imagePreview" v-show="showPreview" /> -->
        <!-- <input type="file" id="file" ref="file" accept="image/*" v-on:change="handleFileUpload()"/> -->
        <!-- <button v-on:click="submitFile()">Submit</button> -->
      </v-card-text>
      <!-- <v-card-actions>
                <v-btn color="primary" block @click="dialog = false">Close Dialog</v-btn>
            </v-card-actions> -->
    </v-card>
  </v-dialog>
</template>

<script>
import axios from 'axios'
import ImageCropperDialog from './ImageCropperDialog.vue'
import defImage from '@/assets/default.jpg'

export default {
  name: 'FilePreviewDialog',
  components: {
    ImageCropperDialog
  },
  props: {
    id:{
      type: Number,
      default: () => 0
    },
    photo_id:{
      type: Number,
      default: () => 0
    },
    dialog: {
      type: Boolean,
      default: () => false
    },
    srcpreview: {
      type: String,
      default: () => '/public/default.jpg'
    }
  },
  data() {
    return {
      photo: {
        id: '',
        photo_id: '',
        title: '',
        descr: ''
      },
      titleImage: '',
      descrImage: '',
      file: '',
      showPreview: false,
      imagePreview: '',
      avatarImage: defImage,
      chosenImage: null,

      rules: [(v) => v.length <= 25 || 'Max 25 characters']
    }
  },
  created() { this.photo.id = this.id; this.photo.photo_id = this.photo_id },
  mounted() {},
  watch: {
    dialog: function () {
      this.showPreview = this.dialog
    },
    srcpreview: function () {
      this.avatarImage = this.srcpreview
    }
  },
  methods: {
    closeDialog() {
      this.$emit('onReset')
    },

    async uploadBlob(base64) {
      var link = document.createElement('a')
      document.body.appendChild(link) // for Firefox
      link.setAttribute('href', base64)
      link.setAttribute('download', 'download.jpg')
      link.click()
    },
    async launchCropper(event) {
      if (!event) return
      var file = event.target.files[0]
      this.chosenImage = await this.toBase64(file)
      this.$refs.cropperDialog.initCropper(file.type)
    },

    async toBase64(file) {
      return new Promise((resolve, reject) => {
        const reader = new FileReader()
        reader.readAsDataURL(file)
        reader.onload = () => resolve(reader.result)
        reader.onerror = (error) => reject(error)
      })
    },

    handleFileUpload() {
      this.file = this.$refs.file.files[0]
      let reader = new FileReader()
      reader.addEventListener(
        'load',
        function () {
          this.showPreview = true
          this.imagePreview = reader.result
        }.bind(this),
        false
      )
      if (this.file) {
        if (/\.(jpe?g|png|gif)$/i.test(this.file.name)) {
          reader.readAsDataURL(this.file)
        }
      }
    },
    submitFile() {
      let formData = new FormData()
      formData.append('file', this.file)
      formData.append('photo', JSON.stringify(this.photo))
      axios
        .post('/savefilepreview', formData, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        })
        .then(function () {
          console.log('SUCCESS!!')
        })
        .catch(function () {
          console.log('FAILURE!!')
        })
    }
  }
}
</script>

<style scope>
.container img {
  max-width: 200px;
  max-height: 200px;
}
</style>
