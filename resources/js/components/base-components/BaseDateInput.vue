<template>
  <div>
    <v-dialog
      ref="dialog"
      v-model="modal"
      :return-value.sync="date"
      persistent
      max-width="290px"
    >
      <template v-slot:activator="{ on, attrs }">
        <v-text-field
          dense
          label="Fecha de nacimiento"
          outlined
          class="pt-1"
          v-model.trim="validation.$model"
          :class="{
            'is-invalid': validation.$error,
            'is-valid': !validation.$invalid,
          }"
          v-mask="'####-##-##'"
          v-bind="attrs"
          v-on="on"
          readonly
        ></v-text-field>
        <v-container class="pb-0 pl-4 pl-1 m-0 my-auto orange-text">
          <v-row v-if="!validation.minDate">
            <i class="material-icons">error_outline</i>
            <p>Fecha debe ser superior a 01/01/1920</p>
          </v-row>
          <v-row v-if="!validation.maxDate">
            <i class="material-icons">error_outline</i>
            <p>Debe de ser mayor de edad.</p>
          </v-row>
        </v-container>
      </template>
      <v-date-picker
        v-model="data"
        min="1920-01-01"
        max="2021-12-27"
        scrollable
        @input="updateValue"
      >
        <v-spacer></v-spacer>
        <v-btn text @click="modal = false"> Cancelar </v-btn>
        <v-btn text @click="$refs.dialog.save(data)"> Guardar </v-btn>
      </v-date-picker>
    </v-dialog>
  </div>
</template>

<script>
export default {
  inheritAttrs: false,
  data() {
    return {
      date: "2021-12-27",
      modal: false,
      data: "2021-12-27",
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
  },
  methods: {
    updateValue(data) {
      //   this.counter++;
      this.$emit("input", data);
    },
    calculateDate() {
      let today = new Date();
      let year = today.getFullYear() - 18;
      let date = today.setFullYear(year);
      this.data = new Date(date).toISOString().split("T")[0];
      this.date = this.data;

      return new Date(date).toISOString();
    },
  },
};
</script>

<style>
.v-picker__title {
  background-color: #374ea8 !important;
}

.v-btn--active .date-color {
  color: #374ea8;
}

div.v-picker__body.v-picker__body--no-title {
  background-color: blue !important;
  color: blue;
}

.v-btn.v-date-picker-table__current.v-btn--outlined {
  border: thin black solid;
}

.v-date-picker-table .v-btn.v-btn--active,
.v-btn.v-btn--active.v-btn--rounded.theme--light.accentv-btn.v-btn--active.v-btn--rounded.theme--light.accent {
  color: #374ea8;
}
</style>
