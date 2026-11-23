
<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'

interface Task {
    id: number
    title: string
    description: string | null
}

const props = defineProps<{
    task?: Task
}>()

const emit = defineEmits<{
    cancel: []
}>()

const form = useForm({
    title: props.task?.title ?? '',
    description: props.task?.description ?? '',
})

function submit() {
    if (props.task) {
        // Update an existing task
        form.put(`/tasks/${props.task.id}`, {
            onSuccess: () => emit('cancel'),
        })
    } else {
        // Create a new task
        form.post('/tasks', {
            onSuccess: () => form.reset(),
        })
    }
}
</script>

<template>
    <form class="flex flex-col gap-5" @submit.prevent="submit">
        <div class="flex flex-col gap-2">
            <label for="title" class="text-sm font-medium">
                Task title
            </label>

            <input
                id="title"
                v-model="form.title"
                type="text"
                maxlength="255"
                required
                :aria-invalid="!!form.errors.title"
                :aria-describedby="form.errors.title ? 'title-error' : undefined"
                class="w-full rounded-lg border border-input bg-background px-4 py-3 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"
            />

            <p v-if="form.errors.title" id="title-error" class="text-sm text-destructive">
                {{ form.errors.title }}
            </p>
        </div>

        <div class="flex flex-col gap-2">
            <label for="description" class="text-sm font-medium">
                Description (Optional)
            </label>

            <textarea
                id="description"
                v-model="form.description"
                rows="3"
                :aria-invalid="!!form.errors.description"
                :aria-describedby="form.errors.description ? 'description-error' : undefined"
                class="w-full resize-y rounded-lg border border-input bg-background px-4 py-3 text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"
            ></textarea>

            <p v-if="form.errors.description" id="description-error" class="text-sm text-destructive">
                {{ form.errors.description }}
            </p>
        </div>

        <div class="flex justify-end gap-3">
            <button
                type="button"
                class="rounded-lg border border-border px-5 py-3 text-sm font-medium"
                @click="emit('cancel')"
            >
                Cancel
            </button>

            <button
                type="submit"
                :disabled="form.processing"
                class="rounded-lg bg-primary px-6 py-3 text-sm font-semibold text-primary-foreground disabled:opacity-60"
            >
                {{ form.processing ? 'Saving...' : props.task ? 'Update Task' : 'Add Task' }}
            </button>
        </div>
    </form>
</template>
