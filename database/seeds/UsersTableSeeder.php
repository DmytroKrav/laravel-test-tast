<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Test Testovich',
                'email' => 'testovich@example.com',
                'password' => 'any_string_for_test',
                'refresh_token' => 'any_string_for_test',
                'created_at' => time(),
                'updated_at' => time()
            ],
            [
                'name' => 'Test 1',
                'email' => 'test1@example.com',
                'password' => 'any_string_for_test',
                'refresh_token' => 'any_string_for_test',
                'created_at' => time(),
                'updated_at' => time()
            ],
        ]);
    }
}
