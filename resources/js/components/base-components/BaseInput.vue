<template>
  <div>
    <v-text-field
      dense
      :label="label"
      outlined
      v-model.trim="data"
      :class="{
        'is-invalid': validation.$error,
        'is-valid': !validation.$invalid,
      }"
      :key="counter"
      :min="min"
      :max="max"
      :type="type"
      @input="updateValue"
      v-mask="mask"
      @keyup="validateText()"
      autocomplete="new-password"
      class="mb-1"
    >
      <v-icon
        slot="append"
        color="green"
        v-if="validationsInput.showPassword"
        @click="showPassword()"
      >
        {{ icon }}
      </v-icon>
    </v-text-field>
    <v-container class="mb-0 pt-0 my-auto orange-text" v-if="validation.$dirty">
      <template v-if="!validationsInput.required">
        <v-row class="pt-0" v-if="!validationsInput.required">
          <p class="mb-0 mt-1 text-muted">(Campo opcional)</p>
        </v-row>
      </template>
      <template>
        <v-row
          v-if="validation.$error && validationsInput.required"
          class="pt-0"
        >
          <p class="mb-0 mt-1">
            <i class="material-icons">error_outline</i> Campo requerido.
          </p>
        </v-row>
        <v-row v-if="validationsInput.minLength && !validation.minLength">
          <p class="pl-0 mt-1">
            <i class="material-icons">error_outline</i> {{ min }} carácter
            mínimo.
          </p>
        </v-row>
        <v-row v-if="validationsInput.maxLength && !validation.maxLength">
          <p class="pl-0 pr-0 mt-1">
            <i class="material-icons">error_outline</i> {{ max }} caracteres
            máximo.
          </p>
        </v-row>
        <v-row v-if="validationsInput.minValue && !validation.minValue">
          <p class="mt-1">
            <i class="material-icons">error_outline</i> {{ min }} es el valor
            mínimo.
          </p>
        </v-row>
        <v-row v-if="validationsInput.maxValue && !validation.maxValue">
          <p class="mt-1">
            <i class="material-icons">error_outline</i> {{ max }} el valor
            máximo.
          </p>
        </v-row>
        <v-row v-if="validationsInput.format && !validation.isValidNumber">
          <p class="mt-1">
            <i class="material-icons">error_outline</i> Formato inválido
          </p>
        </v-row>
        <v-row v-if="validationsInput.isValidDui && !validation.isValidDui">
          <p class="mt-1">
            <i class="material-icons">error_outline</i> DUI inválido
          </p>
        </v-row>
        <v-row v-if="validationsInput.isValidNit && !validation.isValidNit">
          <p class="mt-1">
            <i class="material-icons">error_outline</i> NIT inválido
          </p>
        </v-row>
        <v-row v-if="validationsInput.isValidIsss && !validation.isValidIsss">
          <p class="mt-1">
            <i class="material-icons">error_outline</i> ISSS inválido
          </p>
        </v-row>
        <v-row v-if="validationsInput.isValidAfp && !validation.isValidAfp">
          <p class="mt-1">
            <i class="material-icons">error_outline</i> AFP inválido
          </p>
        </v-row>
        <v-row
          v-if="
            validationsInput.isValidConamypeId && !validation.isValidConamypeId
          "
        >
          <p class="mt-1">
            <i class="material-icons">error_outline</i> ID de Conamype inválido
          </p>
        </v-row>
        <v-row v-if="validationsInput.isValidNrc && !validation.isValidNrc">
          <p class="mt-1">
            <i class="material-icons">error_outline</i> NRC inválido
          </p>
        </v-row>
        <v-row v-if="validationsInput.email && !validation.email">
          <p class="mt-1">
            <i class="material-icons">error_outline</i> Formato de correo
            electrónico inválido.
          </p>
        </v-row>
        <v-row
          v-if="validationsInput.isValidPassword && !validation.isValidPassword"
        >
          <p class="mt-1">
            <i class="material-icons">error_outline</i>
            8 caracteres mínimo.
          </p>
          <p class="mt-1">
            <i class="material-icons">error_outline</i>
            1 mayúscula mínimo.
          </p>
          <p class="mt-1">
            <i class="material-icons">error_outline</i>
            1 minúscula mínimo.
          </p>
          <p class="mt-1">
            <i class="material-icons">error_outline</i>
            13 caracteres máximo.
          </p>
        </v-row>
      </template>
    </v-container>
  </div>
</template>

<script>
export default {
  inheritAttrs: false,
  data() {
    return {
      data: "",
      counter: 0,
      icon: "visibility",
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
    mask: {
      type: String,
      default: "",
    },
    validationsInput: {
      type: Object,
      default: () => {
        return {
          required: true,
          format: false,
          minLength: false,
          maxLength: false,
          minValue: false,
          maxValue: false,
          isValidDui: false,
          isValidNit: false,
          isValidIsss: false,
          isValidAfp: false,
          isValidConamypeId: false,
          isValidNrc: false,
          email: false,
          showPassword: false,
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
  },
  watch: {
    type(val) {
      this.icon = this.type == "password" ? "visibility" : "visibility_off";
    },
  },
  mounted() {
    this.data = this.$attrs.value;
    this.validation.$reset();
  },
  updated() {
    this.data = this.validation.$model;
  },
  methods: {
    updateValue() {
      this.validation.$model = this.data;
      this.$emit("input", this.data);
    },

    validateText() {
      if (this.data) {
        switch (this.validationTextType) {
          case "default":
            this.data = this.data.replace(
              /[^A-ZàèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚñ\' ']/gi,
              ""
            );
            this.data = this.data.replace(/^([a-zA-Z0-9])\1{4}/gi, "");
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
          case "none":
            break;
          case "only-repeats":
            this.data = this.data.replace(/^([a-zA-Z0-9])\1{4}/g, "");
            break;
          default:
            break;
        }
      }

      this.validation.$model = this.data;
      this.$emit("keyup", this.data);
    },

    showPassword() {
      const show = this.type == "password" ? "text" : "password";

      this.$emit("update-password", { show });
    },
  },
};
</script>

<style>
.v-text-field--outlined {
  border-color: #1976d2 !important;
}

.v-text-field--outlined.v-input--is-focused fieldset,
.v-text-field--outlined.v-input--has-state fieldset {
  border-color: #2d52a8 !important;
}

.v-text-field__details {
  display: none;
}

.material-icons {
  width: 30px;
  height: auto;
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
