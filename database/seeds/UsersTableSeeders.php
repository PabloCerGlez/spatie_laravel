<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //usuario con el rol editor 
        $editor=User::create([

'name'=>'editor',
'email'=>'editor@gmail.com',
'password'=>bcrypt('123456')

        ]);

        $editor->assignRole('editor');

        //usuario con el rol moderador 
 $moderador=User::create([

'name'=>'moderador',
'email'=>'moderador@gmail.com',
'password'=>bcrypt('123456')

 ]);
$moderador->assignRole('moderador'); 


         //usuario con el rol superadmin 
$admin=User::create([

'name'=>'admin',
'email'=>'admin@gmail.com',
'password'=>bcrypt('123456')
]);

        $admin->assignRole('super-admin');     
    }
}
