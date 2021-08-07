<?php

namespace App\Http\Controllers\Api;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class TodoController extends Controller
{


    public function store(Request $request)
    {
        try {
            $todo = Todo::create([
                'name' => $request['name'],
                'description' => $request['description'],
                'user_id' => $request['user_id'],
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request, Todo $todo)
    {
        $todo->update($request->all());
    }

    public function completed(Request $request, Todo $todo) {
        $todo->update([
            'is_completed' => true,
            'completed_at' => Carbon::now()
        ]);
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
    }
}
