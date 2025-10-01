import './bootstrap';

import { createApp } from "vue";
import Movies from "./components/Movies.vue";

const app = createApp({});
app.component("movies-component", Movies);
app.mount("#app");
