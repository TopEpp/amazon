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
          'name' => 'admin',
          'password' => bcrypt('123456'),
          'email' => 'admin@admin.com',
          'created_at' => date('Y-m-d H:i:s'),
          'status' => 'Yes',
      ]);
    }
}
