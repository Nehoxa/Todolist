<template>
  <div v-if="showForm" @keyup.enter="submit(), showForm = false">
    <form @submit.prevent="submit" id="todoForm">
      <div class="flex items-center">
        <!-- <TodoCheckbox/> -->
        <input ref="inputField" type="text" class="pl-7 py-0 w-full text-lg border-none bg-transparent active:outline-none input-task" focus
          v-model="form.task">
      </div>
      <input type="text"
        class="w-full text-slate-500 ml-5 py-0 border-none text-base bg-transparent shadow-none outline-none input-note"
        placeholder="Ajouter une note" v-model="form.note">
      <hr class="mx-6 my-3 border-slate-400">
    </form>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useForm } from '@inertiajs/vue3';

const inputField = ref(null);

defineProps({
  showForm: Boolean,
})

const form = useForm({
  task: '',
  note: '',
});

function submit() {
  form.post(route('todos.store'));
  form.reset()
}

onMounted(() => {
  const inputField = document.getElementById('inputField')
  if (inputField) {
    inputField.active()
  }
});

</script>

<style>
.input-note:focus,
.input-task:focus {
  outline-style: none;
  box-shadow: none;
}
</style>
