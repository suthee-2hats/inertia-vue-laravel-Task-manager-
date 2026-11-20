
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
    <main class="min-h-screen bg-background px-4 py-8 text-foreground sm:px-6 sm:py-12">
        <div class="mx-auto w-full max-w-5xl">

            <!-- Page Header -->
            <header class="mb-9 flex flex-col justify-between gap-5 sm:flex-row sm:items-center">
                <div>
                    <span class="text-xs font-bold tracking-[2px] text-muted-foreground">
                        TASK MANAGEMENT
                    </span>

                    <h1 class="mt-2 text-3xl font-bold tracking-tight sm:text-4xl">
                        My Tasks
                    </h1>

                    <p class="mt-2 text-sm leading-relaxed text-muted-foreground">
                        Organize your work and keep track of your progress.
                    </p>
                </div>

                <span
                    class="w-fit rounded-full bg-muted px-4 py-2 text-sm font-semibold text-muted-foreground"
                >
                    {{ tasks.length }} {{ tasks.length === 1 ? 'Task' : 'Tasks' }}
                </span>
            </header>

            <!-- Add Task Section -->
            <section class="rounded-xl border border-border bg-card p-5 shadow-sm sm:p-7">
                <div class="mb-6">
                    <h2 class="text-lg font-semibold">
                        Add a new task
                    </h2>

                    <p class="mt-1.5 text-sm text-muted-foreground">
                        What would you like to accomplish?
                    </p>
                </div>

                <form class="flex flex-col gap-5" @submit.prevent="submit">

                    <!-- Task Title -->
                    <div class="flex flex-col gap-2">
                        <label for="title" class="text-sm font-medium">
                            Task title
                        </label>

                        <input
                            id="title"
                            v-model="form.title"
                            type="text"
                            placeholder="Enter your task title"
                            required
                            maxlength="255"
                            :aria-invalid="!!form.errors.title"
                            :aria-describedby="form.errors.title ? 'title-error' : undefined"
                            class="w-full rounded-lg border border-input bg-background px-4 py-3 text-sm text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 focus-visible:ring-offset-background"
                        />

                        <p
                            v-if="form.errors.title"
                            id="title-error"
                            class="text-sm text-destructive"
                        >
                            {{ form.errors.title }}
                        </p>
                    </div>

                    <!-- Task Description -->
                    <div class="flex flex-col gap-2">
                        <label for="description" class="text-sm font-medium">
                            Description
                            <span class="font-normal text-muted-foreground">
                                (Optional)
                            </span>
                        </label>

                        <textarea
                            id="description"
                            v-model="form.description"
                            rows="3"
                            placeholder="Add more details about your task..."
                            :aria-invalid="!!form.errors.description"
                            :aria-describedby="form.errors.description ? 'description-error' : undefined"
                            class="w-full resize-y rounded-lg border border-input bg-background px-4 py-3 text-sm text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 focus-visible:ring-offset-background"
                        ></textarea>

                        <p
                            v-if="form.errors.description"
                            id="description-error"
                            class="text-sm text-destructive"
                        >
                            {{ form.errors.description }}
                        </p>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="w-full rounded-lg bg-primary px-6 py-3 text-sm font-semibold text-primary-foreground transition-colors hover:bg-primary/90 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 focus-visible:ring-offset-background disabled:cursor-not-allowed disabled:opacity-60 sm:w-auto"
                        >
                            {{ form.processing ? 'Saving...' : '+ Add Task' }}
                        </button>
                    </div>
                </form>
            </section>

            <!-- Task List Section -->
            <section class="mt-7 rounded-xl border border-border bg-card p-5 shadow-sm sm:p-7">
                <div class="mb-6">
                    <h2 class="text-lg font-semibold">
                        Your tasks
                    </h2>

                    <p class="mt-1.5 text-sm text-muted-foreground">
                        Keep track of everything you need to do.
                    </p>
                </div>

                <!-- Empty State -->
                <p
                    v-if="tasks.length === 0"
                    class="rounded-lg border border-dashed border-border px-4 py-10 text-center text-sm text-muted-foreground"
                >
                    No tasks found. Add your first task above.
                </p>

                <!-- Task Items -->
                <ul v-else class="flex flex-col gap-3">
                    <li
                        v-for="task in tasks"
                        :key="task.id"
                        class="flex flex-col gap-3 rounded-lg border border-border p-4 sm:flex-row sm:items-center sm:justify-between sm:gap-5"
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

                        <span
                            class="w-fit shrink-0 rounded-full px-3 py-1.5 text-xs font-semibold"
                            :class="
                                task.is_completed
                                    ? 'bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-300'
                                    : 'bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-300'
                            "
                        >
                            {{ task.is_completed ? 'Completed' : 'Pending' }}
                        </span>
                    </li>
                </ul>
            </section>
        </div>
    </main>
</template>
