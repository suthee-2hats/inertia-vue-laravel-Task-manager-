
<script setup lang="ts">
import Breadcrumbs from '@/components/Breadcrumbs.vue';
import { SidebarTrigger } from '@/components/ui/sidebar';
import { useAppearance } from '@/composables/useAppearance';
import { Sun, Moon } from 'lucide-vue-next';
import type { BreadcrumbItem } from '@/types';
import { ref, onMounted } from 'vue';

withDefaults(
    defineProps<{
        breadcrumbs?: BreadcrumbItem[];
    }>(),
    {
        breadcrumbs: () => [],
    },
);

const { resolvedAppearance, updateAppearance } = useAppearance();

const isMounted = ref(false);

onMounted(() => {
    isMounted.value = true;
});

function toggleTheme() {
    updateAppearance(
        resolvedAppearance.value === 'dark' ? 'light' : 'dark',
    );
}
</script>

<template>
    <header
        class="flex h-16 shrink-0 items-center justify-between gap-2 border-b border-sidebar-border/70 px-6 transition-[width,height] ease-linear group-has-data-[collapsible=icon]/sidebar-wrapper:h-12 md:px-4"
    >
        <div class="flex items-center gap-2">
            <SidebarTrigger class="-ml-1" />

            <template v-if="breadcrumbs && breadcrumbs.length > 0">
                <Breadcrumbs :breadcrumbs="breadcrumbs" />
            </template>
        </div>

        <button
        type="button"
        @click="toggleTheme"
        :aria-label="
            resolvedAppearance === 'dark'
                ? 'Switch to light mode'
                : 'Switch to dark mode'
        "
        :aria-pressed="resolvedAppearance === 'dark'"
        title="Toggle theme"
        class="inline-flex size-9 items-center justify-center rounded-md text-foreground transition-colors hover:bg-accent hover:text-accent-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2"
    >
        <template v-if="isMounted">
            <Sun
                v-if="resolvedAppearance === 'dark'"
                class="size-5"
                aria-hidden="true"
            />
    
            <Moon
                v-else
                class="size-5"
                aria-hidden="true"
            />
        </template>
    
        <span v-else class="size-5" aria-hidden="true"></span>
    </button>
    </header>
</template>
