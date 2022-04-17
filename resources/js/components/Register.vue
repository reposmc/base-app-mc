<template>
  <div class="container mb-4" ref="top" data-app>
    <alert
      :text="textAlert"
      :event="alertEvent"
      :show="showAlert"
      @show-alert="updateAlert($event)"
      class="mb-2"
    />
    <div class="row justify-content-center">
      <div class="col-md-5 col-12">
        <div class="card-body shadow card-rounded">
          <div class="row">
            <div class="col-3 pb-5 mx-auto pl-0 pr-0">
              <img src="/logos/Escudo_D.svg" class="logo-size" alt="Escudo_D" />
            </div>
          </div>
          <h3 class="color-primary text-center">
            Ingresa tus datos para registrarte
          </h3>
          <h6 class="color-primary text-center">
            o <a href="/login" class="no-decoration">inicia sesión aquí</a> si
            ya tienes cuenta.
          </h6>
          <div class="auth">
            <div data-app>
              <v-container width="100%">
                <!-- Form -->
                <v-row>
                  <!-- Name -->
                  <v-col cols="12" xs="12" sm="12" md="12">
                    <base-input
                      label="Nombre"
                      v-model.trim="$v.user.name.$model"
                      :validation="$v.user.name"
                      validationTextType="default"
                      :validationsInput="{
                        required: true,
                        format: false,
                        minLength: true,
                        maxLength: true,
                      }"
                    />
                  </v-col>

                  <!-- Last name -->
                  <v-col cols="12" xs="12" sm="12" md="12">
                    <base-input
                      label="Apellidos"
                      v-model.trim="$v.user.last_name.$model"
                      :validation="$v.user.last_name"
                      validationTextType="default"
                      :validationsInput="{
                        required: true,
                        format: false,
                        minLength: true,
                        maxLength: true,
                      }"
                    />
                  </v-col>

                  <!-- Email -->
                  <v-col cols="12" xs="12" sm="12" md="12">
                    <base-input
                      label="Correo electrónico"
                      v-model.trim="$v.user.email.$model"
                      :validation="$v.user.email"
                      validationTextType="none"
                      :validationsInput="{
                        required: true,
                        minLength: false,
                        maxLength: false,
                        email: true,
                      }"
                    />
                  </v-col>

                  <v-col cols="12" xs="12" sm="12" md="12">
                    <base-input
                      label="Contraseña"
                      v-model.trim="$v.user.password.$model"
                      :validation="$v.user.password"
                      validationTextType="none"
                      :type="typePassword"
                      :min="8"
                      :validationsInput="{
                        required: true,
                        minLength: false,
                        maxLength: false,
                        showPassword: true,
                      }"
                      @update-password="showPassword($event)"
                    >
                    </base-input>
                  </v-col>
                  <!-- Email -->

                  <!-- Password -->
                  <!-- <v-col cols="12" sm="12" md="12">
                    <v-text-field
                      dense
                      label="Contraseña"
                      outlined
                      :type="typePassword"
                      v-model.trim="$v.user.password.$model"
                      :class="{
                        'is-invalid': $v.user.password.$error,
                        'is-valid': !$v.user.password.$invalid,
                      }"
                      oninput="this.value=this.value.replace(/^([a-zA-Z0-9])\1{4}/g,'');"
                    ></v-text-field>
                    <v-container
                      class="pb-2 pt-0 m-0 my-auto orange-text"
                      v-if="$v.user.password.$error"
                    >
                      <v-row v-if="$v.user.password.$error" class="pt-0">
                        <p class="mb-0 mt-1 pl-0">
                          <i class="material-icons">error_outline</i>
                          Campo requerido.
                        </p>
                      </v-row>

                      <v-row v-if="!$v.user.password.isValidPassword">
                        <p class="mb-0 mt-1">
                          <i class="material-icons">error_outline</i>
                          8 caracteres mínimo.
                        </p>
                      </v-row>
                      <v-row v-if="!$v.user.password.isValidPassword">
                        <p class="mb-0 mt-1">
                          <i class="material-icons">error_outline</i>
                          1 mayúscula mínimo.
                        </p>
                      </v-row>
                      <v-row v-if="!$v.user.password.isValidPassword">
                        <p class="mb-0 mt-1">
                          <i class="material-icons">error_outline</i>
                          13 caracteres máximo.
                        </p>
                      </v-row>
                    </v-container>
                  </v-col> -->
                  <!-- Password -->

                  <!-- Confirm password -->
                  <v-col cols="12" sm="12" md="12">
                    <v-text-field
                      dense
                      label="Confirmar contraseña"
                      outlined
                      :type="typePassword"
                      v-model.trim="$v.user.password_confirmation.$model"
                      :class="{
                        'is-invalid': $v.user.password_confirmation.$error,
                        'is-valid': !$v.user.password_confirmation.$invalid,
                      }"
                    >
                    </v-text-field>
                    <v-container
                      v-if="$v.user.password_confirmation.$error"
                      class="pb-2 pt-0 m-0 my-auto orange-text"
                    >
                      <v-row
                        v-if="$v.user.password_confirmation.$error"
                        class="pt-0"
                      >
                        <p class="mb-0 mt-1">
                          <i class="material-icons">error_outline</i>
                          Campo requerido.
                        </p>
                      </v-row>
                      <v-row
                        v-if="!$v.user.password_confirmation.sameAsPassword"
                      >
                        <p class="mb-0 mt-1">
                          <i class="material-icons">error_outline</i>
                          Las contraseñas deben de ser iguales.
                        </p>
                      </v-row>
                    </v-container>
                  </v-col>
                  <!-- Confirm password -->

                  <!-- Show password -->
                  <!-- <v-col cols="12" sm="12" md="12" class="pb-1 pt-1">
                    <a
                      href="#"
                      @click="showPassword($event)"
                      class="no-decoration fw-bold"
                      >{{ showTextPassword }}</a
                    >
                  </v-col> -->
                  <!-- Show password -->

                  <!-- DUI -->
                  <v-col cols="12" xs="12" sm="12" md="12">
                    <base-input
                      label="DUI"
                      v-model="$v.user.dui.$model"
                      :validation.sync="$v.user.dui"
                      validationTextType="only-numbers"
                      :mask="'########-#'"
                      :validationsInput="{
                        required: true,
                        isValidDui: true,
                        minLength: false,
                        maxLength: false,
                      }"
                    />
                  </v-col>
                  <!-- DUI -->
                </v-row>
                <!-- Form -->
                <v-container>
                  <v-row>
                    <v-col
                      cols="12"
                      sm="12"
                      md="12"
                      class="text-center"
                      @click="save()"
                    >
                      <v-btn
                        class="btn btn-normal"
                        style="
                          padding-left: 3rem !important;
                          padding-right: 3rem !important;
                        "
                      >
                        Registrarse
                      </v-btn>
                    </v-col>
                  </v-row>
                </v-container>
              </v-container>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import axios from "axios";
import {
  required,
  minLength,
  maxLength,
  email,
  helpers,
  sameAs,
} from "vuelidate/lib/validators";

export default {
  data() {
    return {
      typePassword: "password",
      optionId: "DUI",
      optionsId: ["DUI"],
      textAlert: "",
      alertEvent: "",
      counterAlert: 0,
      user: {
        name: "Leonel",
        last_name: "Lopez",
        email: "lopezleonel192@gmail.com",
        dui: "12345678-3",
        password: "Leonel23",
        password_confirmation: "Leonel23",
      },
      showTextPassword: "Mostrar contraseña",
      showAlert: false,
    };
  },
  validations: {
    user: {
      name: {
        required,
        minLength: minLength(1),
        maxLength: maxLength(150),
      },
      last_name: {
        required,
        minLength: minLength(1),
        maxLength: maxLength(500),
      },
      email: {
        required,
        email,
      },
      password: {
        required,
        minLength: minLength(8),
        maxLength: maxLength(13),
        isValidPassword: helpers.regex(
          "isValidPassword",
          /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,13}$/
        ),
      },
      password_confirmation: {
        required,
        sameAsPassword: sameAs("password"),
      },
      dui: {
        required,
        isValidDui: helpers.regex("isValidDui", /[0-9]{8}-[0-9]/),
      },
    },
  },
  watch: {
    optionId(val) {
      this.user.dui = "";
      this.$v.$reset();
    },
  },
  methods: {
    async save() {
      this.$v.$touch();
      if (this.$v.$invalid) {
        this.updateAlert(true, "Campos obligatorios.", "fail");
        return;
      }

      //Creating user
      const res = await axios.post(`/register`, this.user).catch((error) => {
        this.textAlert = "No fue posible crear el registro.";

        if (error.response.data.errors.email) {
          this.textAlert = error.response.data.errors.email[0];
        }

        if (error.response.data.errors.dui) {
          this.textAlert = error.response.data.errors.dui[0];
        }

        this.updateAlert(true, this.textAlert, "fail");
        this.$refs.top.scrollIntoView();
      });

      if (res.data.length == []) {
        this.updateAlert(true, "Usuario creado correctamente.", "success");

        setTimeout(() => {
          window.location = "/home";
        }, 3000);
      } else {
        this.updateAlert(true, "El usuario no pudo ser creado.", "fail");
      }

      this.$refs.top.scrollIntoView();
    },

    showPassword(e) {
      this.typePassword = e.show;
    },

    updateAlert(show = false, text = "Alerta", event = "success") {
      this.textAlert = text;
      this.alertEvent = event;
      this.showAlert = show;
    },
  },
};
</script>
