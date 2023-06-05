<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'Cita',
                'tanggal' => '1997-05-01',
                'no_tlp' => '08967890',
                'username' => 'isUser',
                'email' => 'user@mail.com',
                'password' => bcrypt('12345'),
                'photo' => 'user.jpg',
                'roles_id' => 2
            ],
            [
                'name' => 'Ina',
                'tanggal' => '1997-05-01',
                'no_tlp' => '08967890',
                'username' => 'isUser',
                'email' => 'ina@mail.com',
                'password' => bcrypt('123'),
                'photo' => 'ina.jpg',
                'roles_id' => 2
            ],
            [
                'name' => 'isAdmin',
                'tanggal' => '1997-05-01',
                'no_tlp' => '08967890',
                'username' => 'isAdmin',
                'email' => 'admin@mail.com',
                'password' => bcrypt('12345'),
                'photo' => 'admin.jpg',
                'roles_id' => 1
            ]
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
