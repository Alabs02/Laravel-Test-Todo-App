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

            if ($todo){
                return response()->json(['message' => 'Added succesfully'], 201);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 442);
        }
    }

    public function update(Request $request, Todo $todo)
    {
        try {
            $todo->update($request->all());

            if ($todo){
                return response()->json(['message' => 'Updated succesfully'], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function completed(Request $request, Todo $todo) {
        try {
            $todo->update([
                'is_completed' => true,
                'completed_at' => Carbon::now()
            ]);
            if ($todo){
                return response()->json(['message' => 'Updated succesfully'], 200);
            }
        } catch(\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function destroy(Todo $todo)
    {
        try {
            $todo->delete();

            if ($todo) {
                return response()->json(['message' => 'Deleted succesfully'], 200);
            }

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }


    }
}
