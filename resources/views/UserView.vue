<template>
    <div v-if="loading">
        Loading...
    </div>
    <div v-else-if="user">

        <v-tabs v-model="activeTab">
            <v-tab value="profile">Profile</v-tab>
            <v-tab value="projects">Projects</v-tab>
        </v-tabs>

        <div v-if="activeTab === 'profile'">
            <!-- Profile content here -->
            <v-card>
                <v-card-title>{{ user.name }}</v-card-title>
                <v-card-text>
                    <p>Email: {{ user.email }}</p>
                    <p>Joined: {{ user.created_at }}</p>
                </v-card-text>
            </v-card>
        </div>
        <div v-if="activeTab === 'projects'">
            <!-- Projects content here -->
            <v-card v-for="project in user.projects" :key="project.id">
                <v-card-title>{{ project.title }}</v-card-title>
                <v-card-text>
                    <p>{{ project.description }}</p>
                    <h4>Tasks:</h4>
                    <ul>
                        <li v-for="task in project.tasks" :key="task.id">
                            {{ task.title }} - {{ task.status }}
                            <ul>
                                <li>{{ task.description }}</li>
                                <li>Due: {{ task.due_date }}</li>
                            </ul>
                        </li>
                    </ul>
                </v-card-text>
            </v-card>
        </div>
    </div>
    <div v-if="error">
        An error occurred: {{ error.message }}
    </div>
</template>

<script>
import { ref } from 'vue';
import axios from 'axios';

export default {
    props: {
        id: {
            type: String,
            required: true
        }
    },
    setup(props) {
        const user = ref(null);
        const loading = ref(true);
        const error = ref(null);
        const activeTab = ref('profile'); // 初期タブを"profile"に設定

        axios.get(`/api/user/${props.id}`)
            .then(response => {
                user.value = response.data;
                loading.value = false;
            })
            .catch(err => {
                error.value = err;
                loading.value = false;
            });

        return {
            user,
            loading,
            error,
            activeTab
        };
    }
}
</script>
