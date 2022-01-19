import Vuetify from "vuetify";

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue").default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context("./", true, /\.vue$/i, "lazy");

files.keys().map((key) => {
    const names = key
        .split("/")
        .pop()
        .split(".")[0]
        .split(/(?=[A-Z])/); //Getting only the name file Ex: AcademicLevel

    let fullNameComponent = "";

    // Ex: ['Academic', 'Level'];
    names.forEach((name, index) => {
        fullNameComponent +=
            index < names.length - 1
                ? `${name.toLowerCase()}-` // 'academic-'
                : name.toLowerCase(); // 'academic-level'
    });

    // console.log(fullNameComponent, key);
    Vue.component(fullNameComponent, () => import(`${key}`)); //Registering component
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.use(Vuetify);

const app = new Vue({
    el: "#app",
    vuetify: new Vuetify(),
});
