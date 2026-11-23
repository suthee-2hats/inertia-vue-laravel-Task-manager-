
<script setup lang="ts">
import { ref } from 'vue'
import TaskForm from '@/components/tasks/TaskForm.vue'
import { router } from '@inertiajs/vue3'

interface Task {
    id: number
    title: string
    description: string | null
    is_completed: boolean
    created_at: string
    updated_at: string
}

defineProps<{
    task: Task
}>()

function toggleTask(taskId: number) {
    router.patch(`/tasks/${taskId}/toggle`)
}

const isEditing = ref(false)
</script>

<template>
    <li class="rounded-lg border border-border p-4">

        <!-- Editing Mode -->
        <TaskForm
            v-if="isEditing"
            :task="task"
            @cancel="isEditing = false"
        />

        <!-- Normal Display Mode -->
        <div
            v-else
            class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between sm:gap-5"
        >
            <div class="min-w-0">
                <h3 class="break-words text-sm font-semibold">
                    {{ task.title }}
                </h3>

                <p
                    v-if="task.description"
                    class="mt-2 break-words text-sm leading-relaxed text-muted-foreground"
                >
                    {{ task.description }}
                </p>
            </div>

            <div class="flex shrink-0 items-center gap-3">
                <button
                   type="button"
                   class="rounded-lg border border-border px-4 py-2 text-sm font-medium hover:bg-muted focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"
                   @click="toggleTask(task.id)"
                >
                {{ task.is_completed ? 'Mark Pending' : 'Complete' }}
                </button>
                <span
                    class="w-fit rounded-full px-3 py-1.5 text-xs font-semibold"
                    :class="
                        task.is_completed
                            ? 'bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-300'
                            : 'bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-300'
                    "
                >
                    {{ task.is_completed ? 'Completed' : 'Pending' }}
                </span>

                <button
                    type="button"
                    :aria-label="`Edit task: ${task.title}`"
                    class="rounded-lg border border-border px-4 py-2 text-sm font-medium hover:bg-muted focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"
                    @click="isEditing = true"
                >
                    Edit
                </button>
            </div>
        </div>

    </li>
</template>
