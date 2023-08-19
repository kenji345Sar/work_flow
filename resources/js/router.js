import { createRouter, createWebHistory } from "vue-router";
import AboutView from "../views/AboutView.vue"
import HomeView from "../views/HomeView.vue"
import UserView from "../views/UserView.vue";
import RegisterView from "../views/RegisterView.vue";
import AddProjectView from "../views/AddProjectView.vue";
import ProjectTasksView from "../views/ProjectTasksView.vue";
import LoginView from "../views/LoginView.vue";

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
    },
    {
        path: "/register",
        component: RegisterView,
        name: "register"
    },
    {
        path: "/add-project",
        component: AddProjectView,
        name: "addProject"
    },
    {
        path: "/project/:projectId/tasks",
        component: ProjectTasksView,
        name: "projectTasks",
        props: route => ({ projectId: route.params.projectId })
    },
    {
        path: "/login",
        component: LoginView,
        name: "login"
    }
]

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: routes
})

export default router

