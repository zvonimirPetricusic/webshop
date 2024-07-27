<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ContractList;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contract_lists = ContractList::all();
        $users = User::factory()->count(5)->make();

        foreach ($users as $user) {
            if (rand(1, 100) <= 70) {
                $user->contract_list_id = $contract_lists->random()->id;
            }
            $user->save();
        }
    }
}
