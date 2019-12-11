<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersMessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_messages')->insert([
            [
                'message' => 'How are you?',
                'sender_id' => 1,
                'receiver_id' => 2,
                'created_at' => time()
            ],
            [
                'message' => 'I`m fine, and you?',
                'sender_id' => 2,
                'receiver_id' => 1,
                'created_at' => time()
            ],
            [
                'message' => 'lets test test test',
                'sender_id' => 1,
                'receiver_id' => 2,
                'created_at' => time()
            ],
            [
                'message' => 'ok ok ok ok',
                'sender_id' => 1,
                'receiver_id' => 2,
                'created_at' => time()
            ],
            [
                'message' => 'test ets',
                'sender_id' => 2,
                'receiver_id' => 1,
                'created_at' => time()
            ],
        ]);
    }
}
