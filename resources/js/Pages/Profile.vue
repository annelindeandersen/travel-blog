<template>
  <Head title="Profile" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Profile
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            This is your profile, {{ user.name }}. To see overview and change info.
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head, usePage } from '@inertiajs/inertia-vue3';
import { defineComponent, onMounted, computed } from "vue";
import axios from 'axios';

export default defineComponent({
  components: {
    BreezeAuthenticatedLayout,
    Head,
  },
  setup() {
    const user = computed(() => usePage().props.value.auth.user);

    const getProfile = () => {
      axios.get('/getprofile').then(response => {
        console.log(response)
      }).catch(err => console.log(err))
    }

    onMounted(() => {
      console.log('heh', user.value.id)
      getProfile();
    })
    return {user}
  }
})
</script>
