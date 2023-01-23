<?php

namespace Tejuino\Sdk\Database;

use App;
use App\Models\Users\Role;
use App\Models\Users\User;
use Illuminate\Database\Seeder;

class DefaultUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!App::environment(['local', 'staging'])) {
            return false;
        }

        if (User::count() > 0 || Role::count() > 0) {
            return false;
        }

        $roles = ['User', 'Seller', 'Guest', 'Admin', 'Super'];
        foreach ($roles as $role) {
            Role::create([
                'title' => $role
            ]);
        }

        User::create([
            'role_id' => 5,
            'name' => 'Tejuino',
            'email' => 'super@' . config('app.domain'),
            'password' => bcrypt('tejuino')
        ]);
    }
}
