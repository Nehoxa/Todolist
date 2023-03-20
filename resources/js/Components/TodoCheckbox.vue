<template>
  <input type="checkbox" :checked="todo.status === 1" @change="submit"
    class="mr-3 p-2 rounded-full bg-transparent ring-slate-500 text-red-500 ring-2 border-2 border-transparent checked:ring-red-500 ring-offset-none checked:border-2 checked:border-black focus:ring-transparent checked:bg-none my-input">
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  todo: Object,
});

const form = useForm({
  status: props.todo,
});

function submit() {
  form.patch(route('todos.status', props.todo));
};

</script>

<style></style>