<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Inertia\Inertia;
use Spatie\Tags\Tag;
use App\Models\Priority;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Todo::where('user_id', auth()->user()->id)->with('tags')->get();
        $priorities = Priority::all();

        return Inertia::render('Todo', compact('todos', 'priorities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'task' => 'required'
        ]);

        Todo::create([
            'user_id' => auth()->id(),
            'task' => $request->task,
            'note' => $request->note
        ]);

        return Redirect::route('todos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'task' => 'required',
        ]);

        $todo->update([
            'task' => $request->task,
            'note' => $request->note,
            'priority' => $request->priority,
            'date' => $request->date,
            'hour' => $request->hour
        ]);

        return Redirect::route('todos.index');
    }

    public function changeStatus(Todo $todo)
    {
        $status = $todo->status = !$todo->status;
        $todo->update([
            'status' => $status
        ]);
    }

    public function addTag(Request $request, Todo $todo)
    {
        if ($request->tags) {
            $todo->attachTag($request->tags);
        }
    }

    public function deleteTag(Todo $todo, $tag)
    {
        $tag = Tag::find($tag);
        $todo->detachTag($tag);
        $tag->delete();
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();

        return Redirect::route('todos.index');
    }
}
