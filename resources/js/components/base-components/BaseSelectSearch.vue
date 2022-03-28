<template>
  <div>
    <v-autocomplete
      dense
      outlined
      :label="label"
      :items="items"
      :item-text="item"
      :readonly="readonly"
      v-model="validation.$model"
      class="p-0 mt-0"
      @change="$emit('change', validation.$model)"
    ></v-autocomplete>
    <v-row
      v-if="validation.$error && validationsInput.required"
      class="pt-0 orange-text"
    >
      <p class="mb-0 mt-1">
        <i class="material-icons">error_outline</i> Campo requerido.
      </p>
    </v-row>
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
    readonly: {
      type: Boolean,
      default: false,
    },
    validationsInput: {
      type: Object,
      default: () => {
        return {
          required: true,
          minLength: true,
        };
      },
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
