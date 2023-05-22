<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WhithoutModelEvent;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */          
    public function run()
    {
        $users = [
            [
                'name' => 'Gabriel',
                'username' => 'saveasgabriel',
                'email' => 'saveasgabriel@gmail.com.br',
                'password' => '1234',
            ],
            [
                'name' => 'Petrus',
                'username' => 'userpetrus',
                'email' => 'petrus.alves@ufr.edu.br',
                'password' => '1234',
            ],
            [
                'name' => 'Felipe',
                'username' => 'felipeverse',
                'email' => 'felipealvesrrodrigues@outlook.com',
                'password' => '1234',
            ],
        ];
        
        foreach ($users as $userData) {
            $user = User::where('email', $userData['email'])
                        ->orWhere('username', $userData['username'])
                        ->orWhere('name', $userData['name'])
                        ->first();
        
            if (!$user) {
                User::create($userData);
            }
        }
    }
}
