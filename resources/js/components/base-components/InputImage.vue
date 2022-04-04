<template>
  <div>
    <div class="my-auto mx-auto text-center">
      <img :src="imagePreview" alt="" width="200px" height="auto" />
    </div>
    <a href="#" @click="clickInputFile()" class="button-center">
      <i class="material-icons icon-center">folder</i> Seleccionar imagen</a
    >
    <input
      type="file"
      ref="inputImage"
      class="d-none p-3"
      @change="updateImage"
      accept="image/*"
    />
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
      </template>
    </v-container>
  </div>
</template>

<script>
export default {
  data() {
    return {
      imagePreview: "/img/default_image.svg",
      fileName: "",
      sizeFile: "",
    };
  },

  updated() {
    this.image = this.validation.$model;
    // console.log(this.image);
  },

  props: {
    validation: {
      type: Object,
      default: "",
    },
    validationsInput: {
      type: Object,
      default: () => {
        return {
          required: true,
        };
      },
    },
    image: {
      type: String,
      default: "/img/default_image.svg",
    },
  },

  watch: {
    image(val) {
      //   console.log(val);\
      this.imagePreview = this.image;
    },
  },

  update() {
    this.imagePreview = this.image;
  },

  mounted() {
    this.imagePreview = this.image;
  },

  methods: {
    async updateImage(e) {
      const image = await this.toBase64(e.target.files[0]);
      this.$emit("update-image", image);
      this.imagePreview = image;
      //   this.validation.$model = image;
    },

    async toBase64(file) {
      return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = (error) => reject(error);
      });
    },

    clickInputFile() {
      this.$refs.inputImage.click();
    },
  },
};
</script>

<style scoped>
.icon-center {
  vertical-align: middle;
}

.button-center {
  display: flex;
  align-items: center;
}
</style>
