<template>
  <div>
    <v-select
      dense
      outlined
      :label="label"
      :items="items"
      :item-text="item"
      v-model="validation.$model"
      class="p-0 mt-0"
      @change="$emit('change', validation.$model)"
    ></v-select>
  </div>
</template>

<script>
export default {
  inheritAttrs: false,
  data() {
    return {
      data: "",
    };
  },
  props: {
    label: {
      type: String,
      default: "",
    },
    items: {
      type: Array,
      default: [],
    },
    validation: {
      type: Object,
      default: () => {
        return {
          $model: String,
        };
      },
    },
    item: {
      type: String,
      default: "name",
    },
  },
  mounted() {
    this.data = this.validation.$model;
  },
  updated() {
    this.data = this.validation.$model;
  },
  methods: {},
};
</script>

<style>
</style>
