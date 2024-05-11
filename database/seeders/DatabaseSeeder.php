<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ChatRoom;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call(RoleSeeder::class);
        // $team = Team::factory()->create();

        // $user = User::factory(['email'=>'test@example.com','team_id'=>$team->id])->create();

        // $user->assignRole('team_lead');


        // $users = User::factory(
        //     ['team_id'=> $team->id]
        // )->count(9)
        // ->create();
        // $users->each(function ($user) {
        //     $user->assignRole('user');
        // });

        $chatRoom = ChatRoom::factory(
           [ 'name' => 'Team Lead,user',
            'slug' => 'Team_Lead-user',
            'is_private' => false,
            'user_id' => 1,]
        )->create();

        $chatRoom->users()->attach([1,2]);

        $chatRoom->messages()->create([
            'content' => 'hello first message from Team Leader',
            'user_id' => 1,
        ]);

        $chatRoom->messages()->create([
            'content' => 'hello Team Leader im happy to work with you',
            'user_id' => 2
        ]);


        $chatRoom = ChatRoom::factory(
            [ 'name' => 'Marketing 2024',
             'slug' => 'Marketing 2024',
             'is_private' => false,
             'user_id' => 1,]
         )->create();
 
         $chatRoom->users()->attach([1,2]);
 
         $chatRoom = ChatRoom::factory(
            [ 'name' => 'Marketing 2024',
             'slug' => 'Marketing 2024',
             'is_private' => false,
             'user_id' => 1,]
         )->create();
         $chatRoom->users()->attach([1,2]);







        // Team::factory(10)
        // ->has(User::factory()->count(1))->create();

      
        
    }
}
