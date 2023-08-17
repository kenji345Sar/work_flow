<template>
    <form @submit.prevent="register">
        <input type="text" v-model="form.name" placeholder="Name" />
        <input type="email" v-model="form.email" placeholder="Email" />
        <input type="password" v-model="form.password" placeholder="Password" />
        <input type="password" v-model="form.password_confirmation" placeholder="Confirm Password" />

        <button type="submit">Register</button>
    </form>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            form: {
                name: "",
                email: "",
                password: "",
                password_confirmation: ""
            }
        };
    },
    methods: {
        async register() {
            console.log(this.form);  // ここでデータを確認
            try {
                await axios.post("/api/register", this.form);
                // 登録成功時の処理（例：ホームページへのリダイレクト）
                this.$router.push({ name: "home" });
            } catch (error) {
                // エラー処理
                console.error(error);
            }
        }
    }
};
</script>
