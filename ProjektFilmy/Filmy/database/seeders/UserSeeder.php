<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@movietracker.pl',
            'password' => Hash::make('admin1234'),
            'rola'     => 'admin',
            'aktywny'  => true,
        ]);
        User::create([
            'name'     => 'Moderator',
            'email'    => 'mod@movietracker.pl',
            'password' => Hash::make('mod1234'),
            'rola'     => 'moderator',
            'aktywny'  => true,
        ]);
        User::create([
            'name'     => 'Jan Kowalski',
            'email'    => 'jan@movietracker.pl',
            'password' => Hash::make('user1234'),
            'rola'     => 'user',
            'aktywny'  => true,
        ]);
        User::create([
            'name'     => 'Anna Nowak',
            'email'    => 'anna@movietracker.pl',
            'password' => Hash::make('user1234'),
            'rola'     => 'user',
            'aktywny'  => true,
        ]);
    }
}
