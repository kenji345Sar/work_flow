<template>
    <div class="project-tasks">
        <h2>Add Task to Project</h2>

        <v-form @submit.prevent="addTask">
            <v-text-field label="Task Title" v-model="taskTitle" required></v-text-field>
            <v-textarea label="Task Description" v-model="taskDescription"></v-textarea>
            <v-btn type="submit">Add Task</v-btn>
        </v-form>

        <!-- タスクの一覧表示やその他の機能を追加できます -->
    </div>
</template>

<script>
import axios from "axios";

export default {
    props: ["projectId"],
    data() {
        return {
            taskTitle: "",
            taskDescription: "",
            error: null
        };
    },
    created() {
        const token = localStorage.getItem("auth_token");
        if (token) {
            axios.defaults.headers.common["Authorization"] = "Bearer " + token;
        }
    },
    methods: {
        async addTask() {
            try {
                const response = await axios.post(`/api/projects/${this.projectId}/tasks`, {
                    title: this.taskTitle,
                    description: this.taskDescription
                });
                console.log("response:", response.data);
                // タスクが追加されたら、リセットや適切なフィードバックをユーザーに表示できます。

            } catch (error) {
                this.error = "There was an error adding the task. Please try again.";
            }
        }
    }
};
</script>

<style scoped>
/* こちらのスタイルもカスタマイズしてください */
</style>
