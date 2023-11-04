<script setup>
import { RouterLink } from 'vue-router'
</script>

<template>
  <div class="breadcrumbs">
    <v-container class="c-breadcrumbs">
      <v-breadcrumbs :items="items">
        <template v-slot:title="{ item }">
            {{ item.title.toUpperCase() }}
        </template>
      </v-breadcrumbs>
    </v-container>
  </div>
</template>

<script>
export default {
  props: {
    items: {
      type: Array,
      default: () => []
    }
  }
}
</script>

<style scope>
.v-container.c-breadcrumbs {
  padding-top: 10px;
  padding-bottom: 10px;
}
.v-container .v-breadcrumbs {
  padding: 0;
}
.breadcrumbs {
  padding-top: 48px;
  background-color: #f9f9f9;
}
</style>
