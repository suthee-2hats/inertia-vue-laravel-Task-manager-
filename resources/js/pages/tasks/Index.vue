
<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'

interface Task {
    id: number
    title: string
    description: string | null
    is_completed: boolean
    created_at: string
    updated_at: string
}

defineProps<{
    tasks: Task[]
}>()
</script>

<template>
    <AppLayout>
        <div>
            <h1>My Tasks</h1>

            <ul>
                <li v-for="task in tasks" :key="task.id">
                    <h2>{{ task.title }}</h2>
                    <p>{{ task.description }}</p>
                    <span>
                        {{ task.is_completed ? 'Completed' : 'Pending' }}
                    </span>
                </li>
            </ul>

            <p v-if="tasks.length === 0">
                No tasks found.
            </p>
        </div>
    </AppLayout>
</template>
