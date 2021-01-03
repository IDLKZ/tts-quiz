<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                "role_id"=>1,
                "name"=>"Админ",
                "position"=>"Администратор",
                "phone"=>"8700755841256",
                "email"=>"admin@gmail.com",
                "password"=>bcrypt("admin123")
                ]
        );
    }
}
