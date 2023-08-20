<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // プロジェクトの一覧取得
    public function index()
    {
        $projects = Project::all();
        return response()->json($projects);
    }

    // 新しいプロジェクトの作成
    public function store(Request $request)
    {

        // $data = $request->validate([
        //     'title' => 'required|string|max:255',
        //     'description' => 'nullable|string',
        // ]);
        // Log::info($data);
        // // バリデーション後に user_id をデータに追加
        // $data['user_id'] = Auth::id();
        // $project = Project::create($data);
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $project = new Project([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'user_id' => Auth::id(),  // ログインユーザーのIDを取得してセット
        ]);

        $project->save();

        // $data = $request->validate([
        //     'title' => 'required|string|max:255',
        //     'description' => 'nullable|string',
        // ]);
        // // バリデーション後に user_id をデータに追加
        // $data['user_id'] = Auth::id();
        // $project = new Project($data);

        // $project->save();

        // return response()->json($project, 201);
        return response()->json(['message' => 'Project created successfully', 'project' => $project], 201);
    }

    // プロジェクトの詳細取得
    public function show(Project $project)
    {
        return response()->json($project);
    }

    // プロジェクトの更新
    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project->update($data);

        return response()->json($project);
    }

    // プロジェクトの削除
    public function destroy(Project $project)
    {
        $project->delete();

        return response()->json(['message' => 'Project deleted successfully.']);
    }

    public function getUserProjects(Request $request)
    {
        // 認証済みのユーザーIDを取得
        $userId = Auth::id();
        Log::info('test11');
        Log::info($userId);
        Log::info('test22');
        // ユーザーのプロジェクトを取得
        $projects = Project::where('user_id', $userId)->get();
        Log::info($projects);
        return response()->json($projects);
    }
}
