<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	[
        		'name' => 'administrador',
        		'email' => 'admin@rapid-ecommerce.com',
        		'password' => bcrypt('administrador'),
        		'role' => 'admin',
                'shop_name' => 'Rapid Ecommerce'
        	]
        ]);
    }
}
