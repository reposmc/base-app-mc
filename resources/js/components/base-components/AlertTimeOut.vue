<template>
  <div data-app>
    <v-dialog v-model="timeOutDialog" width="500" persistent>
      <v-card>
        <v-container>
          <v-row>
            <v-col cols="12" sm="12" md="12" align="center">
              <h2 class="black-secondary mt-2">Sesión expirada</h2>
              <p>
                Su sesión se ha cerrado automáticamente debido a inactividad.
              </p>
              <p v-if="counterReverse">
                Redirigiendo en: {{ reloading }} segs.
              </p>
            </v-col>
          </v-row>
        </v-container>

        <v-card-actions align="center">
          <v-spacer></v-spacer>
          <v-btn
            class="btn btn-normal mb-2"
            align="center"
            @click="reloadPage()"
          >
            Recargar
          </v-btn>
          <v-spacer></v-spacer>
          <v-btn
            class="btn btn-normal-close mb-2"
            align="center"
            @click="
              timeOutDialog = false;
              $emit('redirect', false);
            "
          >
            Cancelar
          </v-btn>
          <v-spacer></v-spacer>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
export default {
  data() {
    return {
      // 45000
      timeOut: 1785000, // 29.75 mins
      timeOutDialog: false,
      showDialog: false,
      reloading: 15,
      counterReverse: false,
    };
  },

  props: {
    redirect: {
      type: Boolean,
      default: false,
    },
  },

  watch: {
    reloading(val) {
      if (val <= 0) {
        window.location = "/";
      }
    },
    redirect(val) {
      if (val) {
        this.loadHome();
      }
    },
  },

  mounted() {
    if (this.redirect) {
      this.loadHome();
      return;
    }
    this.startTimer();
  },
  methods: {
    startTimer() {
      setTimeout(() => {
        this.counterReverse = true;
        this.timeOutDialog = true;
        setInterval(() => {
          this.reloading -= 1;
          this.deleteCookies();
        }, 1000);
      }, this.timeOut);
    },

    loadHome() {
      this.counterReverse = false;
      this.timeOutDialog = true;
    },

    redirectHome() {
      this.deleteCookies();
      this.timeOutDialog = false;
      window.location = "/";
    },

    deleteCookies() {
      let allCookies = document.cookie.split(";");

      // The "expire" attribute of every cookie is
      // Set to "Thu, 01 Jan 1970 00:00:00 GMT"
      for (let i = 0; i < allCookies.length; i++)
        document.cookie =
          allCookies[i] + "=;expires=" + new Date(0).toUTCString();
    },

    reloadPage() {
      location.reload();
    },
  },
};
</script>
