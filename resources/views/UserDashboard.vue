<template>
    <div class="dashboard">
        <v-container>
            <!-- ユーザー情報セクション -->
            <v-row class="user-info">
                <v-col cols="12" sm="2">
                    <v-avatar size="64"><img :src="user.avatar" alt="User Avatar"></v-avatar>
                </v-col>
                <v-col cols="12" sm="10">
                    <h2>{{ user.name }}</h2>
                    <v-chip>{{ user.email }}</v-chip>
                </v-col>
            </v-row>

            <!-- 進行中のプロジェクトセクション -->
            <v-row class="ongoing-projects">
                <v-col cols="12">
                    <h3>進行中のプロジェクト</h3>
                    <v-list>
                        <v-list-item-group v-for="project in projects" :key="project.id">
                            <v-list-item>
                                <v-list-item-content>
                                    <v-list-item-title>{{ project.title }}</v-list-item-title>
                                    <v-list-item-subtitle>{{ project.description }}</v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                        </v-list-item-group>
                    </v-list>
                </v-col>
            </v-row>

            <!-- タスクセクション -->
            <v-row class="tasks">
                <v-col cols="12">
                    <h3>タスク</h3>
                    <v-list>
                        <v-list-item-group v-for="task in tasks" :key="task.id">
                            <v-list-item>
                                <v-list-item-content>
                                    <v-list-item-title>{{ task.title }}</v-list-item-title>
                                    <v-list-item-subtitle>{{ task.status }}</v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                        </v-list-item-group>
                    </v-list>
                </v-col>
            </v-row>

            <!-- 最近のアクティビティセクション -->
            <v-row class="recent-activity">
                <v-col cols="12">
                    <h3>最近のアクティビティ</h3>
                    <v-list>
                        <v-list-item-group v-for="activity in activities" :key="activity.id">
                            <v-list-item>
                                <v-list-item-content>
                                    <v-list-item-title>{{ activity.action }}</v-list-item-title>
                                    <v-list-item-subtitle>{{ activity.date }}</v-list-item-subtitle>
                                </v-list-item-content>
                            </v-list-item>
                        </v-list-item-group>
                    </v-list>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            user: {},
            projects: [],
            tasks: [],
            activities: []
        };
    },
    created() {
        // Token を設定
        const token = localStorage.getItem('auth_token');
        if (token) {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
        }

        // 各APIを呼び出し
        this.fetchUserData();
        this.fetchUserProjects();
        this.fetchUserTasks();
        // this.fetchRecentActivities();
    },
    methods: {
        async fetchUserData() {
            try {
                // ユーザーデータのAPIエンドポイントを呼び出します
                const response = await axios.get("/api/user");

                // レスポンスデータをuserプロパティにセット
                if (response && response.data) {
                    this.user = response.data;
                } else {
                    console.error("Received unexpected response:", response);
                }
            } catch (error) {
                // APIからエラーレスポンスが返ってきた場合やネットワークエラーなどの場合にエラーメッセージを表示
                console.error("Error fetching user data:", error);
            }
        }
        ,
        async fetchUserProjects() {
            try {
                // ユーザーデータのAPIエンドポイントを呼び出します
                const response = await axios.get("/api/user/projects");

                console.log("Successfully fetched user projects:", response.data);
                // レスポンスデータをuserプロパティにセット
                this.projects = response.data;

            } catch (error) {
                // APIからエラーレスポンスが返ってきた場合やネットワークエラーなどの場合にエラーメッセージを表示
                console.error("Error fetching projects data:", error);
            }



        },
        async fetchUserTasks() {
            try {
                // タスクデータのAPIエンドポイントを呼び出します
                const response = await axios.get("/api/user/tasks");

                // 成功のログ出力
                console.log("Successfully fetched user tasks:", response.data);

                // レスポンスデータをuserTasksプロパティにセット
                this.tasks = response.data;

            } catch (error) {
                // APIからエラーレスポンスが返ってきた場合やネットワークエラーなどの場合にエラーメッセージを表示
                console.error("Error fetching user tasks:", error);
            }
        },
        async fetchRecentActivities() {
            try {
                const response = await axios.get("/api/user/activities");  // このエンドポイントは仮定しています。実際のAPIエンドポイントに変更してください。
                this.activities = response.data;
            } catch (error) {
                console.error("Error fetching recent activities:", error);
            }
        }
    }
};
</script>


<style scoped>
/* ここでスタイルをカスタマイズすることができます */
</style>
