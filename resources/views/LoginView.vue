<template>
    <div>
        <h2>Login</h2>
        <form @submit.prevent="login">
            <div>
                <label>Email:</label>
                <input v-model="email" type="email" required />
            </div>
            <div>
                <label>Password:</label>
                <input v-model="password" type="password" required />
            </div>
            <button type="submit">Login</button>
        </form>
        <!-- エラーメッセージの表示 -->
        <p v-if="errorMessage" style="color: red;">{{ errorMessage }}</p>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            email: '',
            password: '',
            errorMessage: ''  // エラーメッセージを表示するための変数を追加
        };
    },
    methods: {
        async login() {
            try {
                await axios.get('/sanctum/csrf-cookie'); // CSRFトークンを取得
                const response = await axios.post('/api/login', {
                    email: this.email,
                    password: this.password
                });

                if (response.data.token) {
                    // トークンをlocalStorageに保存
                    localStorage.setItem('auth_token', response.data.token);

                    this.$router.push({ name: 'dashboard' });
                } else {
                    this.errorMessage = 'Login failed';
                }
                // if (response.data.message === 'Login successful') {
                //     this.errorMessage = '';  // 成功した場合はエラーメッセージをクリア
                //     this.$router.push({ name: 'home' });
                // }
            } catch (error) {
                this.errorMessage = error.response.data.message || 'Login failed';  // エラーメッセージを設定
                console.error('Login failed:', error.response.data);
            }
        }
    }
};
</script>
