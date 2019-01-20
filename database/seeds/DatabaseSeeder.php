<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
            'username' => 'admin',
            'name' => 'หจก. แม่สอดชานนทร์',
            'phone' => '1111111111',
            'password' => bcrypt('123456'),
            'address' => '88 ถ.สายเอเชีย ต.แม่สอด อ.แม่สอด จ.ตาก 63110',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
