<template>
  <div class="flex" v-for="tags in todo.tags">
    <span class="bg-blue-400 p-1 pr-4 text-sm rounded-md">#{{ tags.name.en }}</span>
  </div>
  <div class="my-2 p-3 bg-gray-600 rounded-md">
    <input type="text" v-model="form.tags"
      class="py-0 px-2 w-full text-md font-medium border-none bg-transparent active:outline-none input-form"
      placeholder="Tag">
  </div>
</template>

<script setup>

defineProps({
  todo: Object
});

</script>
