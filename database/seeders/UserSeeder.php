<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    /**
     * Run the database seeds.
     */
    protected static ?string $password;


    public function run(): void
    {
        User::insert([
            [
                'name' => 'Moch Farrel',
                'username' => 'farrel26',
                'email' => 'gudang@gmail.com',
                'role' => 'Gudang',
                'password' => static::$password ??= Hash::make('password'),
            ],
        ]);
    }
}
