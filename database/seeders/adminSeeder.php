<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class adminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::create([
            'first_name' => 'Ahmed',
            'last_name' => 'Ragab',
            'user_profile_image' => '/default/ahmedragab.png',
            'phone' => '1067610467',
            'country' => 'Egypt',
            'country_code' => '+20',
            'description' =>'Welcome guys , im the admin of this site',
            'email' => 'om5280201@gmail.com',
            'password' => Hash::make('ilovemymother'),
        ]);

        $user->attachRole('admin');
    }
}
