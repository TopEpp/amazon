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
            'first_name' => 'นายทดสอบ',
            'last_name' => 'เทส',
            'password' => bcrypt('123456'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
