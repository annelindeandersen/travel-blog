<template>
  <Head title="Posts" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Posts
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div v-if="message" class="p-5 bg-green-300 rounded-md mb-3">{{ message }}</div>
        <div class="bg-gray-500 overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-gray-500 border-b border-gray-200">
            <h3 class="font-semibold text-lg text-gray-800 leading-tight mb-10">Create new post!</h3>
            <form @submit.prevent="createPost">
              <div class="flex flex-col">
                <input name="title" @input="title = $event.target.value" placeholder="title" class="border-gray-100 rounded-md p-3 mb-10" />
                <textarea name="text" @input="text = $event.target.value" placeholder="text" class="border-gray-100 rounded-md p-3 mb-10" />
                <input name="hero" @input="hero = $event.target.value" placeholder="top image" class="border-gray-100 rounded-md p-3 mb-10" />
                <input name="image" @input="image = $event.target.value" placeholder="image" class="border-gray-100 rounded-md p-3 mb-10" />
                <div class="grid grid-cols-3 gap-5 mb-10">
                  <button class="rounded-md bg-red-400 text-white p-3 cursor-pointer">Add text field</button>
                  <button class="rounded-md bg-blue-300 text-white p-3 cursor-pointer">Add image</button>
                  <button class="rounded-md bg-purple-300 text-white p-3 cursor-pointer">Add quote</button>
                  <button class="rounded-md bg-green-200 text-white p-3 cursor-pointer">Add instagram post</button>
                  <button class="rounded-md bg-pink-300 text-white p-3 cursor-pointer">Add link to video</button>
                  <button class="rounded-md bg-yellow-200 text-white p-3 cursor-pointer">Add blog link</button>
                </div>
                <input placeholder="submit" type="submit" class="mx-auto border-gray-100 rounded-md p-3 w-1/3 cursor-pointer" />
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, usePage } from '@inertiajs/inertia-vue3';
import { defineComponent, computed, ref } from "vue";
import axios from 'axios';

export default defineComponent({
  components: {
    BreezeAuthenticatedLayout,
    Head,
  },
  setup() {
    const user = computed(() => usePage().props.value.auth.user);

    const title = ref('');
    const text = ref('');
    const hero = ref('');
    const image = ref('');
    const message = ref('');

    const createPost = () => {
      console.log(title.value, text.value)
      axios.post('/createpost', {
        title: title.value,
        text: text.value,
        hero: hero.value,
        image: image.value
      }).then(response => {
        console.log(response.data)
        message.value = response.data.message;
      }).catch(err => console.log(err))
    }

    return { user, createPost, title, text, image, hero, message }
  }
})
</script>
