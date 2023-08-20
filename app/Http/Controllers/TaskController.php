<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function store(Request $request, $projectId)
    {
        // プロジェクトの存在を確認
        $project = Project::find($projectId);
        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        // ここでユーザーの権限をチェックするロジックを追加することができます。
        try {
            $data = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
            ]);
            Log::info($data);
            // バリデーション後に project_id をデータに追加
            $data['project_id'] = $projectId;


            $task = Task::create($data);
            return response()->json(['message' => 'Task created successfully', 'task' => $task], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed: ', $e->errors());
            return response()->json(['message' => 'Validation failed', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error creating task: ', $e->getMessage());
            return response()->json(['message' => 'Error creating task'], 500);
        }
    }

    public function getUserTasks(Request $request)
    {
        $user = $request->user(); // 現在認証されているユーザーを取得
        Log::info($user);
        Log::info('aaaaa');

        // ユーザーに関連するタスクを取得
        $tasks = $user->tasks;
        Log::info($tasks); // ログにタスクのデータを出力

        return response()->json($tasks);
    }
}
