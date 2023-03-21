<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Inertia\Inertia;
use Spatie\Tags\Tag;
use Inertia\Response;
use RuntimeException;
use App\Models\Priority;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(): Response
    {
        if (auth()->user() === null) {
            throw new RuntimeException('User Must Be Logged In');
        }

        $todos = Todo::where('user_id', auth()->user()->id)->with('tags')->get();
        $priorities = Priority::all();

        return Inertia::render('Todo', compact('todos', 'priorities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
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
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Todo $todo): RedirectResponse
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

    /**
     * Change the status of Todo
     *
     * @param Todo $todo
     * @return void
     */
    public function changeStatus(Todo $todo): void
    {
        $status = $todo->status = !$todo->status;
        $todo->update([
            'status' => $status
        ]);
    }

    /**
     * Add a Tag for Todo
     *
     * @param Request $request
     * @param Todo $todo
     * @return JsonResponse
     */
    public function addTag(Request $request, Todo $todo): JsonResponse
    {
        if ($request->tags) {
            $todo->attachTag($request->tags);
        }

        return response()->json($todo->tags);
    }

    /**
     * Delete Tag on Todo
     *
     * @param Todo $todo
     * @param string $tag
     * @return JsonResponse
     */
    public function deleteTag(Todo $todo, string $tag): JsonResponse
    {
        $tag = Tag::find($tag);

        if (!$tag instanceof Tag) {
            throw new InvalidArgumentException("Invalid tag ID provided");
        }

        $todo->detachTag($tag);
        $tag->delete();

        return response()->json($todo->tags);
    }


    /**
     * Delete Todo
    *
    * @param Todo $todo
    *  @return \Illuminate\Http\RedirectResponse
    */
    public function destroy(Todo $todo): RedirectResponse
    {
        $todo->delete();
        return Redirect::route('todos.index');
    }
}
