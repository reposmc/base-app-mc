<template>
  <div data-app>
    <alert-time-out :key="alertTimeOut" :redirect="redirectSessionFinished" />
    <v-container style="display: none" ref="alert">
      <v-row>
        <alert :text="textAlert" :event="alertEvent" :key="counterAlert" />
      </v-row>
    </v-container>
    <v-data-table
      :headers="headers"
      :items="recordsFiltered"
      sort-by="cod_dpto"
      class="elevation-3 shadow p-3 mt-3"
    >
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>Departamentos</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-dialog v-model="dialog" max-width="600px" persistent>
            <template v-slot:activator="{ on, attrs }">
              <v-row>
                <v-col align="end">
                  <v-btn
                    class="mb-2 btn-normal no-uppercase"
                    v-bind="attrs"
                    v-on="on"
                    rounded
                  >
                    Agregar
                  </v-btn>
                </v-col>
                <v-col
                  xs="6"
                  sm="6"
                  md="6"
                  class="d-none d-md-block d-lg-block"
                >
                  <v-text-field
                    dense
                    label="Buscar"
                    outlined
                    type="text"
                    class=""
                    v-model="search"
                    @keyup="searchValue()"
                  ></v-text-field>
                </v-col>
              </v-row>
            </template>
            <v-card class="flexcard" height="100%">
              <v-card-title>
                <h1 class="mx-auto pt-3 mb-3 text-center black-secondary">
                  {{ formTitle }}
                </h1>
              </v-card-title>

              <v-card-text>
                <v-container>
                  <!-- Form -->
                  <v-row>
                    <!-- Code Department -->
                    <v-col cols="12" sm="12" md="4" class="department">
                      <v-text-field
                        dense
                        label="Código"
                        outlined
                        type="number"
                        v-model.trim="$v.editedItem.cod_dpto.$model"
                        :class="{
                          'is-invalid': $v.editedItem.cod_dpto.$error,
                          'is-valid': !$v.editedItem.cod_dpto.$invalid,
                        }"
                      ></v-text-field>
                      <v-container
                        class="pb-0 pl-4 pl-1 m-0 my-auto orange-text"
                      >
                        <v-row
                          v-if="!$v.editedItem.cod_dpto.required"
                          class="pt-0"
                        >
                          <i class="material-icons">error_outline</i>
                          <p class="mb-0 mt-1">Campo requerido.</p>
                        </v-row>
                        <v-row v-if="!$v.editedItem.cod_dpto.minLength">
                          <i class="material-icons">error_outline</i>
                          <p>1 carácter mínimo.</p>
                        </v-row>
                        <v-row v-if="!$v.editedItem.cod_dpto.maxLength"
                          ><i class="material-icons">error_outline</i>
                          <p>150 caracteres máximo.</p></v-row
                        >
                      </v-container>
                    </v-col>
                    <!-- Code Department -->
                    <!-- Department Name -->
                    <v-col cols="12" sm="12" md="8" class="department">
                      <v-text-field
                        dense
                        label="Departamento"
                        outlined
                        type="text"
                        class=""
                        v-model.trim="$v.editedItem.department_name.$model"
                        :class="{
                          'is-invalid': $v.editedItem.department_name.$error,
                          'is-valid': !$v.editedItem.department_name.$invalid,
                        }"
                        oninput="this.value=this.value.replace(/[^A-ZàèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚñ\' ']/gi,'');
                        this.value=this.value.replace(/^([a-zA-Z0-9])\1{4}/g,'');"
                      ></v-text-field>
                      <v-container
                        class="pb-0 pl-4 pl-1 m-0 my-auto orange-text"
                      >
                        <v-row
                          v-if="!$v.editedItem.department_name.required"
                          class="pt-0"
                        >
                          <i class="material-icons">error_outline</i>
                          <p class="mb-0 mt-1">Campo requerido.</p>
                        </v-row>
                        <v-row v-if="!$v.editedItem.department_name.minLength">
                          <i class="material-icons">error_outline</i>
                          <p>1 carácter mínimo.</p>
                        </v-row>
                        <v-row v-if="!$v.editedItem.department_name.maxLength"
                          ><i class="material-icons">error_outline</i>
                          <p>150 caracteres máximo.</p></v-row
                        >
                      </v-container>
                    </v-col>
                    <!-- Department Name -->
                  </v-row>
                  <!-- Form -->
                  <v-row>
                    <v-col align="center">
                      <v-btn
                        color="btn-normal no-uppercase mt-3"
                        rounded
                        @click="save"
                      >
                        Guardar
                      </v-btn>

                      <v-btn
                        color="btn-normal-close no-uppercase mt-3"
                        rounded
                        @click="close"
                      >
                        Cancelar
                      </v-btn>
                    </v-col>
                  </v-row>
                </v-container>
              </v-card-text>
            </v-card>
          </v-dialog>
          <v-dialog v-model="dialogDelete" max-width="400px">
            <v-card class="h-100">
              <v-container>
                <h3 class="black-secondary text-center mt-3 mb-3">
                  Eliminar registro
                </h3>
                <v-row>
                  <v-col align="center">
                    <v-btn
                      color="btn-normal no-uppercase mt-3 mb-3 pr-5 pl-5 mx-auto"
                      rounded
                      @click="deleteItemConfirm"
                      >Confirmar</v-btn
                    >
                    <v-btn
                      color="btn-normal-close no-uppercase mt-3 mb-3"
                      rounded
                      @click="closeDelete"
                    >
                      Cancelar
                    </v-btn>
                  </v-col>
                </v-row>
              </v-container>
            </v-card>
          </v-dialog>
        </v-toolbar>
      </template>
      <template v-slot:[`item.actions`]="{ item }">
        <v-icon small class="mr-2" @click="editItem(item)"> mdi-pencil </v-icon>
        <v-icon small @click="deleteItem(item)"> mdi-delete </v-icon>
      </template>
      <template v-slot:no-data>
        <a
          href="#"
          class="btn btn-normal-secondary no-decoration"
          @click="initialize"
        >
          Reiniciar
        </a>
      </template>
    </v-data-table>
  </div>
</template>

<script>
import axios from "axios";
import { required, minLength, maxLength } from "vuelidate/lib/validators";

export default {
  data: () => ({
    search: "",
    dialog: false,
    dialogDelete: false,
    headers: [
      { text: "CÓDIGO", value: "cod_dpto" },
      { text: "NOMBRE", value: "department_name" },
      { text: "ACCIONES", value: "actions", sortable: false },
    ],
    records: [],
    recordsFiltered: [],
    editedIndex: -1,
    editedItem: {
      department_name: "",
      cod_dpto: "",
    },
    defaultItem: {
      department_name: "",
      cod_dpto: "",
    },
    textAlert: "",
    alertEvent: "success",
    counterAlert: 0,
    redirectSessionFinished: false,
    alertTimeOut: 0,
  }),

  //Validations
  validations: {
    editedItem: {
      department_name: {
        required,
        minLength: minLength(1),
        maxLength: maxLength(150),
      },
      cod_dpto: {
        required,
        minLength: minLength(1),
        maxLength: maxLength(150),
      },
    },
  },
  //Validations
  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "Nuevo registro" : "Editar registro";
    },
  },

  watch: {
    dialog(val) {
      val || this.close();
    },
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },

  created() {
    this.initialize();
  },

  methods: {
    async initialize() {
      this.records = [];
      this.recordsFiltered = [];

      const res = await axios.get("api/department").catch((error) => {
        this.textAlert = "No fue posible obtener los registros.";
        this.alertEvent = "fail";
        this.activateAlert();
        this.close();
        this.verifySessionFinished(error.response.status, 401);
      });

      this.records = res.data.departments;
      this.recordsFiltered = res.data.departments;
    },

    editItem(item) {
      this.editedIndex = this.recordsFiltered.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      this.editedIndex = this.recordsFiltered.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },

    async deleteItemConfirm() {
      const res = await axios
        .delete("api/department/" + this.editedItem.id)
        .catch((error) => {
          this.textAlert = "No fue posible eliminar el registro.";
          this.alertEvent = "fail";
          this.activateAlert();
          this.close();
          this.verifySessionFinished(error.response.status, 419);
        });

      if (res.data.message == "success") {
        this.verifySessionFinished(res.status, 200);
        this.textAlert = "Registro eliminado.";
        this.alertEvent = "success";
      } else {
        this.textAlert = "No se pudo eliminar el registro.";
        this.alertEvent = "fail";
      }

      this.activateAlert();
      this.initialize();
      this.closeDelete();
    },

    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    async save() {
      this.$v.$touch();
      if (this.$v.$invalid) {
        this.textAlert = "Campos obligatorios.";
        this.alertEvent = "fail";
        this.activateAlert();
        this.close();
        return;
      }
      if (this.editedIndex > -1) {
        const edited = Object.assign(
          this.recordsFiltered[this.editedIndex],
          this.editedItem
        );

        const res = await axios
          .put("api/department/" + edited.id, edited)
          .catch((error) => {
            this.textAlert = "No fue posible actualizar el registro.";
            this.alertEvent = "fail";
            this.activateAlert();
            this.close();
            this.verifySessionFinished(error.response.status, 419);
          });

        if (res.data.message == "success") {
          this.verifySessionFinished(res.status, 200);
          this.textAlert = "Registro actualizado.";
          this.alertEvent = "success";
        } else {
          this.alertEvent = "fail";
          this.textAlert = "No se pudo actualizar el registro.";
        }

        this.activateAlert();
        this.close();
        this.initialize();
        return;
      } else {
        const res = await axios
          .post("api/department", this.editedItem)
          .catch((error) => {
            this.textAlert = "No fue posible crear el registro.";
            this.alertEvent = "fail";
            this.activateAlert();
            this.close();
            this.verifySessionFinished(error.response.status, 419);
          });

        if (res.data.message == "success") {
          this.verifySessionFinished(res.status, 200);
          this.textAlert = "Registro creado.";
          this.alertEvent = "success";
        } else {
          this.alertEvent = "fail";
          this.textAlert = "No se pudo crear el registro.";
        }

        this.activateAlert();
        this.close();
        this.initialize();
        return;
      }
    },

    searchValue() {
      this.recordsFiltered = [];

      if (this.search != "") {
        this.records.forEach((record) => {
          let searchConcat = "";
          for (let i = 0; i < record.department_name.length; i++) {
            searchConcat += record.department_name[i].toUpperCase();
            if (
              searchConcat === this.search.toUpperCase() &&
              !this.recordsFiltered.some((rec) => rec == record)
            ) {
              this.recordsFiltered.push(record);
            }
          }
        });
        return;
      }

      this.recordsFiltered = this.records;
    },
    activateAlert() {
      this.counterAlert++;
      this.$refs.alert.style.display = "block";
      setTimeout(() => {
        this.$refs.alert.style.display = "none";
      }, 2000);
    },
    verifySessionFinished(status, code) {
      if (status == code) {
        if (status == 419 || status == 401) {
          this.redirectSessionFinished = true;
        }
        this.alertTimeOut++;
      }
    },
  },
};
</script>

