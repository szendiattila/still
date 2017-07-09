<?php

use App\Task;
use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Task::create([
            'name' => 'teszt feladat',
            'description' => 'teszt leírás',
            'finished' => false,
            'user_id' => 1
        ]);

        Task::create([
            'name' => 'teszt feladat 2',
            'description' => 'teszt leírás 2',
            'finished' => true,
            'user_id' => 1
        ]);
    }
}
