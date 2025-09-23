import './bootstrap';
import app from "./app.vue";
import {createApp} from "vue";
import router from "../router/router.js";
import axios from "axios";


createApp(app)
    .use(router, axios,)
    .mount('#app')


