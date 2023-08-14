import { createRouter, createWebHistory } from "vue-router";
import AboutView from "../views/AboutView.vue"
import HomeView from "../views/HomeView.vue"
import UserView from "../views/UserView.vue";

const routes = [
    {
        path: "/about",
        component: AboutView,
        name: "about"
    },
    {
        path: "/",
        component: HomeView,
        name: "home"
    },
    {
        path: "/user/:id",
        component: UserView,
        name: "user",
        props: route => ({ id: route.params.id })
    }
]

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: routes
})

export default router

