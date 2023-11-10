<template>
    <div class="img-block-full">
        <v-img :src="image" contain class="bg-grey-lighten-2 img-full">
            <template v-slot:placeholder>
                <v-row class="fill-height ma-0" align="center" justify="center">
                    <v-progress-circular indeterminate color="grey-lighten-5"></v-progress-circular>
                </v-row>
            </template>
            <div class="image-text-block">
                <h6>{{ title }}</h6>
            </div>
            <v-toolbar density="compact" class="image-tools">

                <div class="d-flex justify-space-around">
                    <v-btn icon="$close" size="large" variant="text" @click="CloseFullImage"></v-btn>
                </div>
            </v-toolbar>
        </v-img>
    </div>
</template>

<script>

export default {
    props: {
        image: String,
        title: String
    },
    data: () => ({

    }),
    methods: {
        CloseFullImage: function () {
            this.$emit('CloseFullImage');
        }
    },

}
</script>

<style scope>
    html{
        overflow-y: auto;
    }
.img-block-full {
    /* position: relative; */
    /* height: calc(100%); */
}

.img-full {
    position: absolute;
    top: 0;
    width: 100vw;
    height: 100vh;
    z-index: 20000;
}

.image-tools {
    top: 0;
}

.img-full img {
    /* width: 100%; */
}
</style>