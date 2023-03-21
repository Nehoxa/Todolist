<template>
  <div v-if="showForm" @keyup.enter="submit(), showForm = false">
    <form @submit.prevent="submit" id="todoForm">
      <div class="flex items-center">
        <input ref="inputTask" type="text"
          class="pl-7 py-0 w-full text-lg border-none bg-transparent active:outline-none input-task" v-model="form.task">
      </div>
      <input ref="inputNote" type="text"
        class="w-full text-slate-500 ml-5 py-0 border-none text-base bg-transparent shadow-none outline-none input-note"
        placeholder="Ajouter une note" v-model="form.note">
      <hr class="mx-6 my-3 border-slate-400">
    </form>
  </div>
</template>

<script setup>
import { ref, onUpdated } from 'vue';
import { useForm } from '@inertiajs/vue3';

const inputTask = ref(null);
const inputNote = ref(null);

const props = defineProps({
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

onUpdated(() => {
  if (props.showForm && document.activeElement !== inputTask.value && document.activeElement !== inputNote.value) {
    inputTask.value.focus();
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
