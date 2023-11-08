<template>
    <v-dialog v-model="showPreview" width="auto">
        <v-card>
            <v-card-title>File Preview.</v-card-title>
            <v-card-text>

                <img v-bind:src="imagePreview" v-show="showPreview" />
                <input type="file" id="file" ref="file" accept="image/*" v-on:change="handleFileUpload()"/>
                <button v-on:click="submitFile()">Submit</button>
            </v-card-text>
            <v-card-actions>
                <v-btn color="primary" block @click="dialog = false">Close Dialog</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>


<script>
import axios from 'axios'

export default {
    name: 'FilePreview',
    props: {
        dialog: {
            type: Boolean,
            default: () => false
        },
    },
    data() {
        return {
            file: '',
            showPreview: false,
            imagePreview: ''
        }
    },
    created() {
        this.showPreview = this.dialog;
    },
    watch: {
        dialog: function() {
            console.log('---'+this.dialog);
                this.showPreview = this.dialog;
            },

    },
    methods: {
        handleFileUpload() {
            this.file = this.$refs.file.files[0];
            let reader = new FileReader();
            reader.addEventListener("load", function () {
                this.showPreview = true;
                this.imagePreview = reader.result;
            }.bind(this), false);
            if (this.file) {
                if (/\.(jpe?g|png|gif)$/i.test(this.file.name)) {
                    reader.readAsDataURL(this.file);
                }
            }
        },
        submitFile() {
            let formData = new FormData();
            formData.append('file', this.file);
            axios.post('/file-preview',
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
            ).then(function () {
                console.log('SUCCESS!!');
            })
                .catch(function () {
                    console.log('FAILURE!!');
                });
        },
    }
}
</script>

<style scope>
.container img {
    max-width: 200px;
    max-height: 200px;
}
</style>