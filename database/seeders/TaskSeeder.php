<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\Project;
use Faker\Factory as FakerFactory;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create('ja_JP');

        $projects = Project::all();

        foreach ($projects as $project) {
            for ($i = 0; $i < 3; $i++) {
                Task::create([
                    'title' => 'プロジェクト' . $project->id . 'のタスク' . ($i + 1),  // 日本語のタイトル
                    'description' => 'これはプロジェクト' . $project->id . 'のタスク' . ($i + 1) . 'の説明です',  // 日本語の説明
                    'due_date' => $faker->dateTimeBetween('-1 month', '+1 month'),
                    'completed' => $faker->boolean,
                    'project_id' => $project->id,
                    'status' => $faker->randomElement(['pending', 'in progress', 'completed']),
                ]);
            }
        }

        // foreach ($projects as $project) {
        //     for ($i = 0; $i < 3; $i++) {
        //         Task::create([
        //             'title' => $faker->realText(20), // ランダムな20文字のテキスト
        //             'description' => $faker->realText(100), // ランダムな100文字のテキスト
        //             'due_date' => $faker->dateTimeBetween('-1 month', '+1 month'), // 1ヶ月前から1ヶ月後のランダムな日付
        //             'completed' => $faker->boolean, // ランダムな真偽値
        //             'project_id' => $project->id,
        //             'status' => $faker->randomElement(['pending', 'in progress', 'completed']), // ランダムなステータス
        //         ]);
        //     }
        // }
    }
}
