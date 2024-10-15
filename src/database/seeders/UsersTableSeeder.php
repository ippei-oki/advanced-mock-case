<?php

namespace Database\Seeders;

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
        $param = [
            'name' => '山田太郎',
            'email' => 'aaa@example.com',
            'email_verified_at' => '2024-09-21 15:56:40',
            'password' => bcrypt('99999999'),
            'created_at' => '2024-09-21 15:56:40',
            'updated_at' => '2024-09-21 15:56:40',
            'role' => 'admin'
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => '山田次郎',
            'email' => 'bbb@example.com',
            'email_verified_at' => '2024-09-21 15:56:40',
            'password' => bcrypt('99999999'),
            'created_at' => '2024-09-21 15:56:40',
            'updated_at' => '2024-09-21 15:56:40',
            'role' => 'store_representative',
            'shop_id' => '1'
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => '山田三郎',
            'email' => 'ccc@example.com',
            'email_verified_at' => '2024-09-21 15:56:40',
            'password' => bcrypt('99999999'),
            'created_at' => '2024-09-21 15:56:40',
            'updated_at' => '2024-09-21 15:56:40',
            'role' => 'user'
        ];
        DB::table('users')->insert($param);
    }
}
