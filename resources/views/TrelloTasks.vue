<!-- resources/js/components/TrelloTasks.vue -->

<template>
    <div>
        <h2>Trello Tasks</h2>
        <ul>
            <li v-for="task in tasks" :key="task.id">{{ task.name }}</li>
        </ul>
    </div>
</template>

<script>
export default {
    data() {
        return {
            tasks: []
        };
    },
    mounted() {
        axios.get('/api/trello-tasks')
            .then(response => {
                this.tasks = response.data;
            })
            .catch(error => {
                console.error("There was an error fetching the Trello tasks:", error);
            });
    }
}
</script>
