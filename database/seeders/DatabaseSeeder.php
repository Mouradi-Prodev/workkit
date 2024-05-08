<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $team = Team::factory()->create();

        $user = User::factory(['email'=>'test@example.com','team_id'=>$team->id])->create();

        $user->assignRole('team_lead');


        $users = User::factory(
            ['team_id'=> $team->id]
        )->count(9)
        ->create();
        $users->each(function ($user) {
            $user->assignRole('user');
        });


        // Team::factory(10)
        // ->has(User::factory()->count(1))->create();

      
        
    }
}
