<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Days;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Admin::create([
            'name' => 'Administrator',
            'email' => 'admin.sman1turen@gmail.com',
            'password' => Hash::make('4dminsman1turen'),
        ]);

        Days::insert([
            ['nama' => 'Senin'],
            ['nama' => 'Selasa'],
            ['nama' => 'Rabu'],
            ['nama' => 'Kamis'],
            ['nama' => 'Jumat'],
            ['nama' => 'Sabtu'],
        ]);
    }
}
