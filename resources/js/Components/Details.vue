<template>
  <div class="fixed z-50 inset-0 overflow-y-auto">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
      <div class="fixed inset-0 transition-opacity">
        <div class="absolute inset-0 bg-gray-500 opacity-75" id="bg-details" @click="close"></div>
      </div>

      <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;
      <div
        class="inline-block align-bottom bg-gray-700 rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
        <div>
          <div class="text-center mt-0 mx-2">

            <header class="flex mb-4 justify-between">
              <button class="text-lg leading-6 font-medium text-blue-400 w-20 text-left" id="close-button" @click="close">
                Annuler
              </button>
              <h3 class="text-lg leading-6 font-bold text-white w-20">Détails</h3>
              <button class="text-lg leading-6 font-medium text-blue-400 w-20 text-right" @click="submit">OK</button>
            </header>

            <form @submit.prevent="submit">
              <div class="mt-2">
                <div class="my-2 p-3 bg-gray-600 rounded-md">
                  <input type="text" v-model="form.task" @keydown.enter="submit"
                    class="py-0 px-2 w-full text-md font-medium border-none bg-transparent active:outline-none input-form"
                    placeholder="Titre">
                  <hr class="mx-2 my-3 border-slate-500">
                  <input type="text" v-model="form.note" @keydown.enter="submit"
                    class="py-0 px-2 w-full text-md font-medium border-none bg-transparent active:outline-none input-form"
                    placeholder="Note">
                </div>

                <div class="mt-2 p-3 bg-gray-600 rounded-md">
                  <div class="flex items-center">
                    <button @click="resetDate" class="flex" v-if="form.date">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                    </button>
                    <input type="date" v-model="form.date" @keydown.enter="submit"
                      class="py-0 px-2 w-full text-md font-medium border-none bg-transparent active:outline-none input-form">
                  </div>

                  <hr class="mx-2 my-3 border-slate-500">

                  <div class="flex items-center">
                    <button @click="resetHour" class="flex" v-if="form.hour">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                    </button>
                    <input type="time" v-model="form.hour" @keydown.enter="submit"
                      class="py-0 px-2 w-full text-md font-medium border-none bg-transparent active:outline-none input-form">
                  </div>
                </div>

                <TagComponents :todo="todo" />

                <div class="my-2 p-3 bg-gray-600 rounded-md">
                  <span class="fixed mx-2 font-medium">Priorité</span>
                  <select v-model="form.priority" @keydown.enter="submit"
                    class="py-0 pl-2 pr-10 text-right w-full text-md border-none bg-transparent active:outline-none input-form">
                    <option value="" selected>Aucune</option>
                    <option v-for="priority in priorities" :key="priority.id" :value="priority.name">{{ priority.name }}
                    </option>
                  </select>
                </div>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { router } from '@inertiajs/vue3';
import { reactive } from 'vue'
import TagComponents from '@/Components/TagComponents.vue'


const props = defineProps({
  todo: Object,
  priorities: Object,
});

const form = reactive({
  task: props.todo.task,
  note: props.todo.note,
  priority: props.todo.priority,
  hour: props.todo.hour,
  date: props.todo.date,
})

function close(event) {
  if (event.target.id === "bg-details" || event.target.id === "close-button") {
    router.visit(route('todos.index'))
  }
}

function resetDate() {
  form.date = null;
}

function resetHour() {
  form.hour = null;
}

function submit() {
  router.patch(route('todos.update', props.todo), form);
}

</script>

<style scoped>
.input-form:focus {
  outline-style: none;
  box-shadow: none;

}
</style>