
<script setup lang="ts">
import TaskItem from '@/components/tasks/TaskItem.vue'

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
    <!-- Empty State -->
    <p
        v-if="tasks.length === 0"
        class="rounded-lg border border-dashed border-border px-4 py-10 text-center text-sm text-muted-foreground"
    >
        No tasks found. Add your first task above.
    </p>

    <!-- Task Items -->
    <ul v-else class="flex flex-col gap-3">
        <TaskItem
            v-for="task in tasks"
            :key="task.id"
            :task="task"
        />
    </ul>
</template>
