<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name'              =>      'John Smith',
            'email'             =>      'john.smith@gmail.com',
            'password'          =>      Hash::make('password'),
            'remember_token'    =>      Str::random(10)
        ]);
    }
}
