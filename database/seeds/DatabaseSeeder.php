<?php

use Illuminate\Database\Seeder;
use App\User;
class DatabaseSeeder extends Seeder
{

    public function run()
    {
      User::create(array(
        'nombre'=>'Admin',
        'email'=>'admin@admin.com',
        'password'=>bcrypt('admin'),
        'rol'=>'admin',
        'telefono'=>'3413510683',
        'direccion'=>'CENTENO 3012',
        'dni'=>'12345678'
    ));

        // $this->call(UsersTableSeeder::class);
    }
}
