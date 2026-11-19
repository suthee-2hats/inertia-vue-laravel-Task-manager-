
<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'

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

const form = useForm({
    title: '',
    description: '',
})

function submit() {
    form.post('/tasks', {
        onSuccess: () => form.reset(),
    })
}
</script>

<template>
    <main>
        <h1>My Tasks</h1>

        <form @submit.prevent="submit">
            <div>
                <label for="title">Task title</label>
                <input
                    id="title"
                    v-model="form.title"
                    type="text"
                    required
                />
                <p v-if="form.errors.title">
                    {{ form.errors.title }}
                </p>
            </div>

            <div>
                <label for="description">Description</label>
                <textarea
                    id="description"
                    v-model="form.description"
                />
                <p v-if="form.errors.description">
                    {{ form.errors.description }}
                </p>
            </div>

            <button type="submit" :disabled="form.processing">
                {{ form.processing ? 'Saving...' : 'Add Task' }}
            </button>
        </form>

        <hr />

        <p v-if="tasks.length === 0">No tasks found.</p>

        <ul v-else>
            <li v-for="task in tasks" :key="task.id">
                <h2>{{ task.title }}</h2>
                <p>{{ task.description }}</p>
                <span>
                    {{ task.is_completed ? 'Completed' : 'Pending' }}
                </span>
            </li>
        </ul>
    </main>
</template>
