<template>
  <v-container class="pb-1 ml-0 pb-3" :class="color" ref="alert" v-if="show">
    <v-row>
      <v-col cols="3" sm="3" md="1" class="pt-1">
        <v-icon class="alert-icon text-white">mdi-bell-outline </v-icon>
      </v-col>
      <v-col cols="6" sm="6" md="10" align="center" class="pt-2">
        <h6 class="text-white my-auto">{{ text }}</h6>
      </v-col>
      <v-col cols="3" sm="3" md="1" class="pt-1">
        <a href="#" class="no-decoration" @click="hideAlertNow()">
          <v-icon class="alert-icon text-white no-decoration">mdi-close</v-icon>
        </a>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      color: "alert-success",
      timeOut: "",
    };
  },
  watch: {
    show() {
      this.showAlert();
    },
  },
  props: {
    text: {
      type: String,
      default: "",
    },
    event: {
      type: String,
      default: "success",
    },
    disabled: false,
    init: false,
    time: {
      type: Number,
      default: 5000,
    },
    show: {
      type: Boolean,
      default: false,
    },
  },
  watch: {
    event(val) {
      if (val == "success") {
        this.color = "alert-success";
      } else {
        this.color = "alert-fail";
      }
    },
  },
  mounted() {
    this.showAlert();
  },
  updated() {
    this.showAlert();
  },
  methods: {
    showAlert() {
      if (this.event == "success") {
        this.color = "alert-success";
      } else {
        this.color = "alert-fail";
      }

      this.hideAlert();

      // When the users is disabled
      if (this.disabled) {
        setTimeout(() => {
          window.location = "/";
        }, 5000);
      }
    },

    hideAlert() {
      window.clearTimeout(this.timeOut);
      this.timeOut = setTimeout(() => {
        this.$emit("show-alert", false);
      }, this.time);
    },

    hideAlertNow() {
      this.$emit("show-alert", false);
    },
  },
};
</script>

<style scoped>
.alert-success {
  background-color: #4880ff;
}

.alert-fail {
  background-color: #f3a723;
}
</style>
