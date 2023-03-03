<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Nivel;
use App\Models\Usuario;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $nivel = new Nivel();
        $nivel->name = 'empleado';
        $nivel->save();

        $nivel2 = new Nivel();
        $nivel2->name = 'jefe';
        $nivel2->save();

        $nivel3 = new Nivel();
        $nivel3->name = 'particular';
        $nivel3->save();

        $usuario = new Usuario();
        $usuario->name = 'jhon lopez';
        $usuario->status = true;
        $usuario->observation = 'texto prueba';
        $usuario->password = '123456';
        $usuario->nivel_id = $nivel->id;
        $usuario->save();

        $usuario2 = new Usuario();
        $usuario2->name = 'jhon lopez';
        $usuario2->status = true;
        $usuario2->observation = 'texto prueba';
        $usuario2->password = '123456';
        $usuario2->nivel_id = $nivel2->id;
        $usuario2->save();

        $usuario3 = new Usuario();
        $usuario3->name = 'jhon lopez';
        $usuario3->status = true;
        $usuario3->observation = 'texto prueba';
        $usuario3->password = '123456';
        $usuario3->nivel_id = $nivel3->id;
        $usuario3->save();




 
    }



}
