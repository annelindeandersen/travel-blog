<template>
  <Head title="Blog" />

  <div :class="darkMode ? 'bg-gray-500' : 'bg-gray-100'" class="relative flex items-top justify-center min-h-screen sm:items-center sm:pt-0">

    <div v-if="canLogin" class="bg-gray-700 fixed flex justify-end items-center w-screen top-0 h-12 px-6 py-4">
      <button @click="() => darkMode = !darkMode" :class="darkMode ? 'bg-white' : 'bg-gray-700'" class="py-2 px-3 rounded-full fixed top-1 left-3">{{ darkMode ? '☀️' : '🌙' }}</button>
      <Link v-if="$page.props.auth.user" href="/dashboard" class="text-sm text-white underline">
        Dashboard
      </Link>
      <template v-else>
        <Link :href="route('login')" class="text-sm text-white underline">
          Login
        </Link>
        <Link v-if="canRegister" :href="route('register')" class="ml-4 text-sm text-white underline">
          Register
        </Link>
      </template>
    </div>

    <div v-if="posts" class="max-w-6xl mx-auto sm:p-6 lg:p-8 lg:pt-16">
      <a :href="'/post?id=' + posts[0].id">
        <div class="h-96">
          <img :src="posts[0].hero" :alt="posts[0].id" class="object-cover object-center w-full h-full" />
        </div>
        <h2 class="font-medium text-3xl">{{ posts[0].title }}</h2>
      </a>
      <div class="my-5 grid grid-cols-3 gap-x-5 gap-y-10">
        <div v-for="post in posts.slice(1,10)" class="w-full h-48">
          <a :href="'/post?id=' + post.id">
            <img :src="post.hero" :alt="post.id" class="w-full h-full object-cover object-center" />
            <h2 class="font-medium text-2xl">{{ post.title }}</h2>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
import { defineComponent, onMounted, ref } from "vue";
import axios from 'axios';

export default defineComponent({
  components: {
    Head,
    Link,
  },
  props: {
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
  },
  setup() {
    const posts = ref('');
    const darkMode = ref(false);

    const getPosts = () => {
      axios.get('/getposts').then(response => {
        console.log(response)
        posts.value = response.data;
      }).catch(err => console.log(err))
    }

    onMounted(() => {
      getPosts();
    })
    return { posts, darkMode }
  }
})
</script>
