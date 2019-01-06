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
            'name' => 'นายทดสอบ เทส',
            'phone' => '1111111111',
            'password' => bcrypt('123456'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
