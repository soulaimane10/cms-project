<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersTableSeeder extends Seeder
{
  public function run()
    {
      // $user = User::where('email', "algorithm@gmail.com")->first();
      $user = DB::table('users')->where('email', 'soulaimane@gmail.com')->first();

      if (! $user) {
        User::create([
          'name' => 'soulaimane',
          'email' => 'soulaimane@gmail.com',
          'password' => Hash::make('123456'),
          'role' => 'admin'
        ]);
      }

    }
}
