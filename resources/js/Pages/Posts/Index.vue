<template>
    <Head title="PostList" />
    <!-- <Head>
        <title>Post Lists</title>
    </Head> -->
    <AppLayout>
        <Link v-if="permissions.posts_manage" :href="route('posts.create')" class="inline-block px-4 py-3 bg-blue-500 text-white rounded mb-4">Add Post</Link>
        <table class="min-w-full divide-y divide-gray-200 border">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left">
                        <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">ID</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left">
                        <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Title</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left">
                        <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Content</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left">
                        <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Created at</span>
                    </th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                <tr v-for="post in posts">
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                        {{ post.id }}
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                        {{ post.title }}
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                        {{ post.content }}
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                        {{ post.created_at }}
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                        <Link v-if="permissions.posts_manage" :href="route('posts.edit', post.id)" type="button" class="px-2 py-1 bg-blue-600 text-white rounded font-bold uppercase">
                            Edit
                        </Link>
                        <button v-if="permissions.posts_manage" @click="destroy(post.id)" type="button" class="px-2 py-1 bg-red-600 text-white rounded font-bold uppercase">
                            Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </AppLayout>
</template>

<script setup>
import AppLayout from "../../Layouts/App.vue";
import { Head, Link, router } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";
defineProps({
    posts: Object,
    permissions: Object
});

function destroy(id) {
    if(confirm('Are you sure')) {
        // Inertia.delete(route('posts.destroy', id));
        router.delete(route('posts.destroy', id))
    }
}

</script>