<template>
    <div class="add-project">
        <h2>Add New Project</h2>

        <v-form @submit.prevent="addProject">
            <v-text-field label="Project Title" v-model="title" required></v-text-field>

            <v-textarea label="Description" v-model="description"></v-textarea>

            <v-btn type="submit">Add Project</v-btn>
        </v-form>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            title: '',
            description: '',
            error: null
        };
    },
    created() {
        const token = localStorage.getItem('auth_token');
        if (token) {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
        }
    },
    methods: {
        async addProject() {
            try {
                const response = await axios.post("/api/projects", {
                    title: this.title,
                    description: this.description
                });
                console.log('response:', response.data)
                // 成功時の処理。例えば、ユーザーをプロジェクトのページにリダイレクトするなど。
                this.$router.push(`/project/${response.data.project.id}/tasks`);

            } catch (error) {
                // エラー処理。例えば、エラーメッセージの表示など。
                this.error = "There was an error adding the project. Please try again.";
            }
        }
    }
};
</script>

<style scoped>
/* ここにスタイルを追加できます */
.form-group {
    margin-bottom: 20px;
}

.error-message {
    color: red;
}
</style>
