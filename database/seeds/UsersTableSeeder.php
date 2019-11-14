<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Daniel',
            'last_name' => 'Gonzalez Briseno',
            'username' => 'sonusbeat',
            'email' => 'sonusbeat@hotmail.com',
            'password' => bcrypt('secret1234'),
        ]);

        $this->command->info('Users Table Seeded ! :)');
    }
}
