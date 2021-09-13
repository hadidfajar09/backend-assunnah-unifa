<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = new \App\Models\User;
        $administrator->email = "administrator@arabic-class.test";
        $administrator->password = \Hash::make("09090909");
        $administrator->name = "Application Administrator";
        $administrator->level = "admin";
        $administrator->gender = "wanita";
        $administrator->avatar = "none.png";
        $administrator->address = "Limbung";
        $administrator->phone = "083138090578";
        $administrator->save();
        $this->command->info("User Admin berhasil di-insert");
    }
}
