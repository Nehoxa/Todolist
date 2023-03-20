<template>
  <div v-for="todo in todos" :key="todo.id" class="group">
    <div v-if="todo.status === 0">
      <div class="flex items-center justify-between">
        <div>
          <TodoCheckbox :todo="todo" />
          <span class="text-red-500 mr-1" v-if="todo.priority === 'Faible'">!</span>
          <span class="text-red-500 mr-1" v-if="todo.priority === 'Moyenne'">!!</span>
          <span class="text-red-500 mr-1" v-if="todo.priority === 'Élevée'">!!!</span>
          <span class="text-lg">{{ todo.task }}</span>
        </div>
        <Details :todo="todo" :priorities="priorities" v-if="todo.details" />
        <div class="flex">
          <button @click.prevent="openDetails(todo)" class="hidden group-hover:block hover:text-yellow-500 text-slate-600 mr-6"
            method="delete" as="button" type="button">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
            </svg>
          </button>
          <Link :href="route('todos.destroy', todo.id)"
            class="hidden group-hover:block hover:text-red-700 text-slate-600 mr-6" method="delete" as="button"
            type="button">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
          </svg>
          </Link>
        </div>
      </div>
      <span v-if="todo.note" class="text-slate-400 ml-8 text-base">{{ todo.note }}</span>
      <div class="flex ml-8">
        <span v-if="todo.date" class="text-slate-400 mr-2 text-base">{{ formatDate(todo.date) }}</span>
        <span v-if="todo.hour" class="text-slate-400 mr-2 text-base">{{ formatHour(todo.hour) }}</span>
        <div v-for="tags in todo.tags">
          <span class="text-blue-300 text-base mr-2">#{{ tags.name.en }}</span>
        </div>
      </div>
      <hr class="mx-6 my-3 border-slate-400">
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import TodoCheckbox from './TodoCheckbox.vue';
import Details from './Details.vue'
import { format } from 'date-fns';

defineProps({
  todos: Object,
  priorities: Object,
});

function openDetails(todo) {
  todo.details = !todo.details;
}

function formatDate(date) {
  return format(new Date(date), 'dd/MM/yyyy');
}

function formatHour(hour) {
  return format(new Date(`2000-01-01T${hour}`), 'HH:mm');
}

</script>