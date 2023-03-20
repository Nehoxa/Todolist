<template>
  <div class="flex">
    <div class="bg-blue-400 pl-2 p-1 text-sm rounded-md mr-1 font-semibold flex justify-between items-center"
      v-for="tags in todo.tags">
      <span>#{{ tags.name.en }}</span>
      <button type="button" @click="deleteTag(tags)">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
        class="w-4 h-4 ml-1">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
      </svg>
    </button>
  </div>
  </div>
  <div class="my-2 p-3 bg-gray-600 rounded-md" @keydown.space="addTag" @keydown.enter="addTag"> 
    <input type="text" v-model="form.tags"
      class="py-0 px-2 w-full text-md font-medium border-none bg-transparent active:outline-none input-form"
      placeholder="Tag">
  </div>
</template>

<script setup>
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3';

const props = defineProps({
  todo: Object,
});

const form = reactive({
  tags: null,
});

function addTag() {
  if (form.tags != null) {
    router.patch(route('todos.tag', props.todo), form);
    form.tags = '';
  }
}

function deleteTag(tag) {
  console.log('coucou');
  router.delete(route('todos.deleteTag', [props.todo, tag]));
}

</script>

<style scoped>
.input-form:focus {
  outline-style: none;
  box-shadow: none;

}
</style>