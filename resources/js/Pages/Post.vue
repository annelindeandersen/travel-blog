<template>
  <Head :title="post.title" />

  <div :class="darkMode ? 'bg-gray-500' : 'bg-gray-100'" class="relative flex items-top justify-center min-h-screen sm:pt-0">

    <div v-if="canLogin" class="bg-gray-700 bg-opacity-10 fixed flex justify-end items-center w-screen top-0 h-12 px-6 py-4">
      <button @click="() => darkMode = !darkMode" :class="darkMode ? 'bg-white' : 'bg-gray-700'" class="py-2 px-3 rounded-full fixed top-1 left-3">{{ darkMode ? '☀️' : '🌙' }}</button>
      <Link v-if="$page.props.auth.user" href="/dashboard" class="text-sm text-white underline">
        Dashboard
      </Link>
      <template v-else>
<!--        <Link :href="route('')" class="text-sm text-white underline">
          Home
        </Link>-->
        <Link :href="route('login')" class="text-sm text-white underline">
          Login
        </Link>
        <Link v-if="canRegister" :href="route('register')" class="ml-4 text-sm text-white underline">
          Register
        </Link>
      </template>
    </div>

    <div v-if="post">
      <div class="h-96 w-screen">
        <img :src="post.hero" :alt="post.id" class="object-cover object-center w-full h-full" />
      </div>
      <div class="max-w-6xl mx-auto pt-9">
        <h2 class="font-medium uppercase tracking-wide text-3xl pb-2">{{ post.title }}</h2>
        <p class="font-thin pb-2">{{ post.text }}</p>
      </div>

<!--      <div class="my-5 grid grid-cols-3 gap-5">
        <div v-for="post in posts.slice(1,7)" class="w-full h-48">
          <img :src="post.hero" :alt="post.id" class="w-full h-full object-cover object-center" />
          <h2 class="font-medium text-2xl">{{ post.title }}</h2>
        </div>
      </div>-->
    </div>
  </div>
</template>

<script>
import { Head, Link, usePage } from '@inertiajs/inertia-vue3';
import { computed, defineComponent, onMounted, ref } from "vue";
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
    const post = ref('');
    const darkMode = ref(false);

    const page = computed(() => usePage().url.value);

    console.log(page.value, page.value.slice(9))

    const getPost = () => {
      axios.get('/getpost', {
        params: {
          id: page.value.slice(9)
        }
      }).then(response => {
        console.log(response)
        post.value = response.data[0];
      }).catch(err => console.log(err))
    }

    onMounted(() => {
      getPost();
    })
    return { post, darkMode }
  }
})
</script>
