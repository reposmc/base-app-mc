<template>
  <div data-app>
    <alert-time-out
      :redirect="redirectSessionFinished"
      @redirect="updateTimeOut($event)"
    />
    <alert
      :text="textAlert"
      :event="alertEvent"
      :show="showAlert"
      @show-alert="updateAlert($event)"
      class="mb-2"
    />
    <v-data-table
      :headers="headers"
      :items="recordsFiltered"
      sort-by="name"
      class="elevation-3 shadow p-3 mt-3"
    >
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>Municipios</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-dialog v-model="dialog" max-width="600px" persistent>
            <template v-slot:activator="{ on, attrs }">
              <v-row>
                <v-col align="end">
                  <v-btn
                    class="mb-2 btn-normal"
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
                  <!-- Department Name -->
                  <v-row v-if="departments.length > 0">
                    <v-col cols="12" sm="6" md="6">
                      <base-select
                        label="Departamentos"
                        v-model.trim="$v.editedItem.department_name.$model"
                        :items="departments"
                        item="department_name"
                        :validation="$v.editedItem.department_name"
                      />
                    </v-col>
                    <!-- Department Name -->
                    <!-- Municipality Name-->
                    <v-col cols="12" sm="6" md="6">
                      <base-input
                        label="Nombre municipio"
                        v-model="$v.editedItem.municipality_name.$model"
                        :validation="$v.editedItem.municipality_name"
                        validationTextType="default"
                        :validationsInput="{
                          required: true,
                          format: false,
                          minLength: true,
                          maxLength: true,
                        }"
                      />
                    </v-col>
                    <!-- Municipality Name-->
                    <!-- Mun min -->
                    <v-col cols="12" sm="6" md="6">
                      <base-input
                        label="Nombre municipio"
                        v-model="$v.editedItem.mun_min.$model"
                        :validation="$v.editedItem.mun_min"
                        validationTextType="default"
                        :validationsInput="{
                          required: true,
                          format: false,
                          minLength: true,
                          maxLength: true,
                        }"
                      />
                    </v-col>
                    <!-- Mun min -->
                    <!-- Mun may -->
                    <v-col cols="12" sm="6" md="6">
                      <base-input
                        label="Nombre municipio"
                        v-model="$v.editedItem.mun_may.$model"
                        :validation="$v.editedItem.mun_may"
                        validationTextType="default"
                        :validationsInput="{
                          required: true,
                          format: false,
                          minLength: true,
                          maxLength: true,
                        }"
                      />
                    </v-col>
                    <!-- Mun may -->
                    <!-- dm_cod -->
                    <v-col cols="12" sm="6" md="6">
                      <base-input
                        label="Nombre municipio"
                        v-model="$v.editedItem.dm_cod.$model"
                        :validation="$v.editedItem.dm_cod"
                        validationTextType="default"
                        :validationsInput="{
                          required: true,
                          format: false,
                          minLength: true,
                          maxLength: true,
                        }"
                      />
                    </v-col>
                    <!-- dm_cod -->
                    <!-- cod_mun -->
                    <v-col cols="12" sm="6" md="6">
                      <base-input
                        label="Nombre municipio"
                        v-model="$v.editedItem.cod_mun.$model"
                        :validation="$v.editedItem.cod_mun"
                        validationTextType="default"
                        :validationsInput="{
                          required: true,
                          format: false,
                          minLength: true,
                          maxLength: true,
                        }"
                      />
                    </v-col>
                    <!-- cod_mun -->
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
import departmentApi from "../apis/departmentApi";
import municipalityApi from "../apis/municipalityApi";
import lib from "../libs/function";
import { required, minLength, maxLength } from "vuelidate/lib/validators";

export default {
  data: () => ({
    search: "",
    dialog: false,
    dialogDelete: false,
    headers: [
      { text: "CÓDIGO", value: "cod_mun" },
      { text: "NOMBRE", value: "municipality_name" },
      { text: "DEPARTAMENTO", value: "department_name" },
      { text: "MINÚSCULAS", value: "mun_min" },
      { text: "MAYUSCULA", value: "mun_may" },
      { text: "DEP-MUN COD", value: "dm_cod" },
      { text: "ACCIONES", value: "actions", sortable: false },
    ],
    records: [],
    recordsFiltered: [],
    editedIndex: -1,
    editedItem: {
      municipality_name: "",
      department_name: "Ahuachapán",
      mun_min: "",
      mun_may: "",
      dm_cod: "",
      cod_mun: "",
    },
    defaultItem: {
      municipality_name: "",
      department_name: "Ahuachapán",
      mun_min: "",
      mun_may: "",
      dm_cod: "",
      cod_mun: "",
    },
    textAlert: "",
    alertEvent: "success",
    showAlert: false,
    departments: [],
    redirectSessionFinished: false,
  }),

  // Validations
  validations: {
    editedItem: {
      municipality_name: {
        required,
        minLength: minLength(1),
        maxLength: maxLength(150),
      },
      department_name: {
        required,
      },
      mun_min: {
        required,
        minLength: minLength(1),
        maxLength: maxLength(150),
      },
      mun_may: {
        required,
        minLength: minLength(1),
        maxLength: maxLength(150),
      },
      dm_cod: {
        required,
        minLength: minLength(1),
        maxLength: maxLength(150),
      },
      cod_mun: {
        required,
        minLength: minLength(1),
        maxLength: maxLength(150),
      },
    },
  },
  // Validations
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

      let requests = [municipalityApi.get(), departmentApi.get()];
      let responses = await Promise.all(requests).catch((error) => {
        this.updateAlert(true, "No fue posible obtener los registros.", "fail");
        this.redirectSessionFinished = lib.verifySessionFinished(
          error.response.status,
          401
        );
      });

      this.records = responses[0].data.municipalities;
      this.departments = responses[1].data.departments;

      this.recordsFiltered = this.records;
    },

    editItem(item) {
      this.dialog = true;
      this.editedIndex = this.recordsFiltered.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.$v.editedItem.department_name.$model =
        this.editedItem.department_name;
    },

    deleteItem(item) {
      this.editedIndex = this.recordsFiltered.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },

    async deleteItemConfirm() {
      const res = await municipalityApi
        .delete(`/${this.editedItem.id}`)
        .catch((error) => {
          this.updateAlert(
            true,
            "No fue posible eliminar el registros.",
            "fail"
          );
          this.close();
        });

      if (res.data.status == "success") {
        this.redirectSessionFinished = lib.verifySessionFinished(
          res.status,
          200
        );
        this.updateAlert(true, "Registro eliminado.", "success");
      } else {
        this.updateAlert(true, "No se pudo eliminar el registro.", "fail");
      }

      this.activateAlert();
      this.initialize();

      this.closeDelete();
    },

    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = this.defaultItem;
        this.editedIndex = -1;
      });
    },

    closeDelete() {
      this.$nextTick(() => {
        this.editedItem = this.defaultItem;
        this.editedIndex = -1;
      });

      this.dialogDelete = false;
    },

    async save() {
      this.$v.$touch();
      if (this.$v.$invalid || this.editedItem.department_name == "") {
        this.updateAlert(true, "Campos obligatorios.", "fail");
        return;
      }

      if (this.editedIndex > -1) {
        const res = await municipalityApi
          .put(`/${this.editedItem.id}`, this.editedItem)
          .catch((error) => {
            this.updateAlert(true, "No fue posible crear el registro.", "fail");
            this.close();
            this.redirectSessionFinished = lib.verifySessionFinished(
              error.response.status,
              419
            );
          });

        if (res.data.status == "success") {
          this.updateAlert(
            true,
            "Registro almacenado correctamente.",
            "success"
          );
        }
      } else {
        const res = await municipalityApi
          .post(null, this.editedItem)
          .catch((error) => {
            this.updateAlert(true, "No fue posible crear el registro.", "fail");
            this.close();
          });

        if (res.data.status == "success") {
          this.updateAlert(
            true,
            "Registro almacenado correctamente.",
            "success"
          );
        }
      }
      this.close();
      this.initialize();
    },

    searchValue() {
      this.recordsFiltered = [];

      if (this.search != "") {
        this.records.forEach((record) => {
          let searchConcat = "";
          for (let i = 0; i < record.municipality_name.length; i++) {
            searchConcat += record.municipality_name[i].toUpperCase();
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

    updateAlert(show = false, text = "Alerta", event = "success") {
      this.textAlert = text;
      this.alertEvent = event;
      this.showAlert = show;
    },

    updateTimeOut(event) {
      this.redirectSessionFinished = event;
    },
  },
};
</script>

