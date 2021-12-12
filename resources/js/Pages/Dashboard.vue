<template>
  <Head title="Dashboard" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            Dashboard of posts etc.

            <table class="table-fixed">
              <thead>
                <tr>
                  <th class="w-1/6">ID</th>
                  <th class="w-1/3">Title</th>
                  <th class="w-1/3">Text</th>
                  <th class="w-1/6">Published</th>
                  <th class="w-1/6">Manage</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="post in posts" class="border-gray-400">
                  <td class="border-gray-400">{{ post.id }}</td>
                  <td class="border-gray-400">{{ post.title }}</td>
                  <td class="border-gray-400">{{ post.text }}</td>
                  <td class="border-gray-400">{{ post.published }}</td>
                  <td class="border-gray-400">
                    <button class="bg-green-300">Edit</button>
                    <button @click="deletePost(post.id)" class="bg-red-400">Delete</button>
                  </td>
                </tr>
              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, usePage } from '@inertiajs/inertia-vue3';
import { defineComponent, onMounted, computed, ref } from "vue";
import axios from 'axios';
import Button from "@/Components/Button";

export default defineComponent({
  components: {
    Button,
    BreezeAuthenticatedLayout,
    Head,
  },
  setup() {
    const user = computed(() => usePage().props.value.auth.user);

    const posts = ref('');

    const getPosts = () => {
      axios.get('/getposts').then(response => {
        console.log(response)
        posts.value = response.data;
      }).catch(err => console.log(err))
    }

    const deletePost = (id) => {
      console.log('delete', id);
    }

    onMounted(() => {
      getPosts();
    })

    return { user, posts, deletePost }
  }
})
</script>
