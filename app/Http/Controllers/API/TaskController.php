<?php

namespace App\Http\Controllers\API;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

            $save = new Task();
            $save->title = $request->title;
            $save->save();
            return response()->json([
                "success" => true,
                "data" => $save,
                "message" => "Task successfully Created!",

            ]);

    }
    public function show($id)
    {
        $task = Task::find($id);
        return response()->json($task);
    }
    public function update(Request $request, $id)
    {

        $task = Task::find($id);
        $task->title = $request->title;
        $task->update();
        return response()->json([
            'status' => 200,
            'data' => $task,
            'message' => 'Task Updated Successfully',
        ]);
    }
    public function destroy($id)
    {
        //return 'ok';
        $task = Task::find($id);
        return $task;
        $task->delete();
        return response()->json('Task Details deleted successfully');
    }
}
