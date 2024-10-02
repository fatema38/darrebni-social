<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users =[
            [
                'name' => 'abd',
                'email' => 'abd@abd.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0933333333',
                'role_id' => 1,
                'facebook'=>"https://www.facebook.com/",
                'linkedin'=>"https://www.linkedin.com/in/" ,
                'twitter'=>"https://twitter.com/",
                'gmail'=>'mailto:fatmthwrany520@gmail.com',
                'profile_picture'=>'images\default\profile_picture.jpg'
            ],
            [
                'name' => 'abd2',
                'email' => 'abd2@abd2.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0933333333',
                'role_id' => 4,
                'facebook'=>"https://www.facebook.com/",
                'linkedin'=>"https://www.linkedin.com/in/" ,
                'twitter'=>"https://twitter.com/",
                'gmail'=>'mailto:fatmthwrany520@gmail.com',
                'profile_picture'=>'images\default\profile_picture.jpg'
            ],
            [
                'name' => 'abd3',
                'email' => 'abd3@abd3.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0933333333',
                'role_id' => 3,
                'facebook'=>"https://www.facebook.com/",
                'linkedin'=>"https://www.linkedin.com/in/" ,
                'twitter'=>"https://twitter.com/",
                'gmail'=>'mailto:fatmthwrany520@gmail.com',
                'profile_picture'=>'images\default\profile_picture.jpg'
            ],
            [
                'name' => 'abd4',
                'email' => 'abd4@abd4.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0933333333',
                'role_id' => 3,
                'facebook'=>"https://www.facebook.com/",
                'linkedin'=>"https://www.linkedin.com/in/" ,
                'twitter'=>"https://twitter.com/",
                'gmail'=>'mailto:fatmthwrany520@gmail.com',
                'profile_picture'=>'images\default\profile_picture.jpg'
            ],
            [
                'name' => 'abd5',
                'email' => 'abd5@abd5.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0933333333',
                'role_id' => 3,
                'facebook'=>"https://www.facebook.com/",
                'linkedin'=>"https://www.linkedin.com/in/" ,
                'twitter'=>"https://twitter.com/",
                'gmail'=>'mailto:fatmthwrany520@gmail.com',
                'profile_picture'=>'images\default\profile_picture.jpg'
            ],
            [
                'name' => 'abd6',
                'email' => 'abd6@abd6.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0933333333',
                'role_id' => 3,
                'facebook'=>"https://www.facebook.com/",
                'linkedin'=>"https://www.linkedin.com/in/" ,
                'twitter'=>"https://twitter.com/",
                'gmail'=>'mailto:fatmthwrany520@gmail.com',
                'profile_picture'=>'images\default\profile_picture.jpg'
            ],
            [
                'name' => 'abd7',
                'email' => 'abd7@abd7.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0933333333',
                'role_id' => 3,
                'facebook'=>"https://www.facebook.com/",
                'linkedin'=>"https://www.linkedin.com/in/" ,
                'twitter'=>"https://twitter.com/",
                'gmail'=>'mailto:fatmthwrany520@gmail.com',
                'profile_picture'=>'images\default\profile_picture.jpg'
            ],
            [
                'name' => 'abd8',
                'email' => 'abd8@abd8.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0933333333',
                'role_id' => 3,
                'facebook'=>"https://www.facebook.com/",
                'linkedin'=>"https://www.linkedin.com/in/" ,
                'twitter'=>"https://twitter.com/",
                'gmail'=>'mailto:fatmthwrany520@gmail.com',
                'profile_picture'=>'images\default\profile_picture.jpg'
            ],
            [
                'name' => 'abd9',
                'email' => 'abd9@abd9.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0933333333',
                'role_id' => 3,
                'facebook'=>"https://www.facebook.com/",
                'linkedin'=>"https://www.linkedin.com/in/" ,
                'twitter'=>"https://twitter.com/",
                'gmail'=>'mailto:fatmthwrany520@gmail.com',
                'profile_picture'=>'images\default\profile_picture.jpg'
            ],
            [
                'name' => 'abd10',
                'email' => 'abd10@abd10.com',
                'password' => Hash::make('123456'),
                'phone_number' => '0933333333',
                'role_id' => 3,
                'facebook'=>"https://www.facebook.com/",
                'linkedin'=>"https://www.linkedin.com/in/" ,
                'twitter'=>"https://twitter.com/",
                'gmail'=>'mailto:fatmthwrany520@gmail.com',
                'profile_picture'=>'images\default\profile_picture.jpg'
            ],

        ];
        foreach ($users as $user)
        {
            User::create($user);
        }
    }
}
