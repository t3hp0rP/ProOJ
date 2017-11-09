<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//         $this->call(UsersTableSeeder::class);
//        $this->call(QuizTableSeeder::class);
//        $this->command->info('Quiz Seed Success!');
//
//        $this->call(RecordSeeder::class);
//        $this->command->info('Record seed Success!');

        $this->call(AdminSeeder::class);
        $this->command->info('Admin seed Success!');
    }
}
