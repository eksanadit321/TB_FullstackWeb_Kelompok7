<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            [
                'name'          => 'Admin',
                'email'         => 'admin@mail.com',
                'password'      => bcrypt('kelompok7'),
                'created_at'    => date("Y-m-d H:i:s"),
				'role'          => 'admin'
            ],
            [
                'name'          => 'Staff',
                'email'         => 'staff@mail.com',
                'password'      => bcrypt('kelompok7'),
                'created_at'    => date("Y-m-d H:i:s"),
				'role'          => 'staff'
            ],
        ]);
    }
}
