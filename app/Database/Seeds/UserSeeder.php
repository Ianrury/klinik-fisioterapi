<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Models\UserModel;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = model(UserModel::class);

        $users = auth()->getProvider();

        $user = new User([
            'username' => 'Admin',
            'email'    => 'admin@email.com',
            'password' => '123456789ccd',
        ]);

        $users->save($user);

        // To get the complete user object with ID, we need to get from the database
        $user = $users->findById($users->getInsertID());

        // Add to default group
        $users->addToAdminGroup($user);

        // Aktifkan user
        $user->activate();
    }
}
