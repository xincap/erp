<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        \XinGroup\Model\User::create([
            'name' => 'admin',
            'email'=> 'admin@xin-group.com',
            'password'=> Hash::make('admin'),
            'created_at'=> Carbon\Carbon::now(),
            'updated_at'=> Carbon\Carbon::now(),
        ]);
    }

}
