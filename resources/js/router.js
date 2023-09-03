import { createRouter, createWebHistory } from "vue-router";
import AboutView from "../views/AboutView.vue"
import HomeView from "../views/HomeView.vue"
import UserView from "../views/UserView.vue";
import RegisterView from "../views/RegisterView.vue";
import AddProjectView from "../views/AddProjectView.vue";
import ProjectTasksView from "../views/ProjectTasksView.vue";
import LoginView from "../views/LoginView.vue";
import UserDashboard from "../views/UserDashboard.vue";
import TrelloTasks from "../views/TrelloTasks.vue";

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
    },
    {
        path: "/dashboard",
        component: UserDashboard,
        name: "dashboard"
    },
    {
        path: '/trello-tasks',
        component: TrelloTasks
    }
]

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: routes
})

router.beforeEach((to, from, next) => {
    const loggedIn = localStorage.getItem('auth_token');

    // ルートが認証を要求するかどうかを確認
    if (to.matched.some(record => record.meta.requiresAuth) && !loggedIn) {
        next({ name: 'login' });  // ログインページにリダイレクト
    } else {
        next();  // それ以外の場合は通常通りルートに進む
    }
});

export default router

