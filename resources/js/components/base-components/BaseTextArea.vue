<template>
  <div>
    <v-textarea
      :label="label"
      outlined
      auto-grow
      row-height="30"
      :rows="rows"
      v-model.trim="data"
      :class="{
        'is-invalid': validation.$error,
        'is-valid': !validation.$invalid,
      }"
      @input="updateValue"
    >
    </v-textarea>
    <div class="pb-0 pt-0 pl-4 pl-1 m-0 my-auto orange-text">
      <v-row v-if="validationsInput.required && validation.$error">
        <p class="mb-0 mt-0">
          <i class="material-icons mt-0">error_outline</i> Campo requerido.
        </p>
      </v-row>
      <v-row v-if="validationsInput.minLength && !validation.minLength">
        <p>
          <i class="material-icons">error_outline</i> {{ min }} carácter mínimo.
        </p>
      </v-row>
      <v-row v-if="validationsInput.maxLength && !validation.maxLength">
        <p>
          <i class="material-icons">error_outline</i> {{ max }} caracteres
          máximo.
        </p>
      </v-row>
    </div>
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
    validation: {
      type: Object,
      default: "",
    },
    validationTextType: {
      type: String,
      default: "",
    },
    required: {
      type: Boolean,
      default: false,
    },
    type: {
      type: String,
      default: "text",
    },
    validationsInput: {
      type: Object,
      default: () => {
        return {
          required: true,
          minLength: false,
          maxLength: false,
        };
      },
    },
    min: {
      type: Number,
      default: 0,
    },
    max: {
      type: Number,
      default: 150,
    },
    rows: {
      type: Number,
      default: 4,
    },
    margin: {
      type: String,
      default: "mt-5",
    },
  },
  mounted() {
    this.data = this.$attrs.value;
  },
  updated() {
    this.data = this.validation.$model;
  },
  methods: {
    updateValue(data) {
      this.$emit("input", data);
    },
    validateText() {
      switch (this.validationTextType) {
        case "default":
          this.data = this.data.replace(
            /[^A-ZàèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚñ\' ']/gi,
            ""
          );
          this.data = this.data.replace(/^([a-zA-Z0-9])\1{4}/g, "");
          break;
        case "only-letters":
          this.data = this.data.replace(
            /[^A-ZàèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚñ\' ']/gi,
            ""
          );
          break;
        case "only-numbers":
          this.data = this.data.replace(/[^0-9\-]/g, "");
          break;
        case "only-numbers":
          this.data = this.data.replace(/[^0-9\-]/g, "");
          break;
        case "none":
          break;
        case "only-repeats":
          this.data = this.data.replace(/^([a-zA-Z0-9])\1{4}/g, "");
          break;
        default:
          break;
      }
    },
  },
};
</script>

<style>
.theme--light.v-input,
.theme--light.v-input input,
.theme--light.v-input textarea {
  height: 100% !important;
}

.v-messages,
.v-text-field__details {
  display: none;
}

p {
  margin-bottom: 0px;
  height: 20px;
  line-height: 20px; /* same as height! */
  display: flex;
  justify-content: left;
  align-content: center;
  flex-direction: row;
}
</style>
