<template>
  <div>
    <v-autocomplete
      dense
      outlined
      :label="label"
      :items="items"
      item-text="name"
      v-model="data"
      :class="{
        'is-invalid': !validation.$model,
        'is-valid': validation.$model,
      }"
      class="p-0 mt-0"
      @input="updateValue"
    ></v-autocomplete>
    <v-container class="pb-0 pl-4 pl-1 m-0 my-auto orange-text">
      <v-row v-if="!validation.$model" class="pt-0">
        <i class="material-icons">error_outline</i>
        <p class="mb-0 mt-1">Campo requerido.</p>
      </v-row>
    </v-container>
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
      default: [],
    },
  },
  mounted() {
    this.data = this.validation.$model;
    console.log("Select: " + this.data);
  },
  updated() {
    this.data = this.validation.$model;
    console.log("Select: " + this.data);
  },
  methods: {
    updateValue(data) {
      console.log(data);
      this.$emit("input", data);
    },
  },
};
</script>

<style>
</style>
