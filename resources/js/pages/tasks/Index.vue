
<script setup lang="ts">

import TaskForm from '@/components/tasks/TaskForm.vue';
import TaskLIst from '@/components/tasks/TaskLIst.vue';


interface Task {
    id: number
    title: string
    description: string | null
    is_completed: boolean
    created_at: string
    updated_at: string
}

interface Statistics {
    total: number
    completed: number
    pending: number
}
defineProps<{
    tasks: Task[]
    statistics: Statistics
}>()

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

                <TaskForm />
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

                <TaskLIst :tasks="tasks" />
            </section>

            <section
    aria-label="Task statistics"
    class="mb-6 grid grid-cols-1 gap-3 sm:grid-cols-3"
>
    <div class="rounded-lg border border-border p-4">
        <p class="text-sm text-muted-foreground">Total Tasks</p>
        <p class="mt-1 text-2xl font-semibold">
            {{ statistics.total }}
        </p>
    </div>

    <div class="rounded-lg border border-border p-4">
        <p class="text-sm text-muted-foreground">Completed</p>
        <p class="mt-1 text-2xl font-semibold">
            {{ statistics.completed }}
        </p>
    </div>

    <div class="rounded-lg border border-border p-4">
        <p class="text-sm text-muted-foreground">Pending</p>
        <p class="mt-1 text-2xl font-semibold">
            {{ statistics.pending }}
        </p>
    </div>
</section>

        </div>
    </main>
</template>
