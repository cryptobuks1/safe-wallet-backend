<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\User;
use App\Balance;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [ 'name' => 'Pau', 'email' => 'Pau@mail.com'],
            [ 'name' => 'Vicente', 'email' => 'Vicente@mail.com'],
            [ 'name' => 'Gilberto', 'email' => 'Gilberto@mail.com'],
            [ 'name' => 'Ismael', 'email' => 'Ismael@mail.com'],
            [ 'name' => 'Beltran', 'email' => 'Beltran@mail.com'],
            [ 'name' => 'Aitor', 'email' => 'Aitor@mail.com'],
            [ 'name' => 'Mauro', 'email' =>  'Mauro@mail.com'],
            [ 'name' => 'Jesus', 'email' => 'Jesus@mail.com'],
            [ 'name' => 'Gaizka', 'email' => 'Gaizka@mail.com'],
            [ 'name' => 'Nestor', 'email' => 'Nestor@mail.com'],
            [ 'name' => 'Miguel', 'email' => 'Miguel@mail.com'],
            [ 'name' => 'Guillermo', 'email' => 'Guillermo@mail.com'],
            [ 'name' => 'Braulio', 'email' => 'Braulio@mail.com'],
            [ 'name' => 'Benjamin', 'email' => 'Benjamin@mail.com'],
            [ 'name' => 'Gorka', 'email' => 'Gorka@mail.com'],
            [ 'name' => 'Kiko', 'email' => 'Kiko@mail.com'],
            [ 'name' => 'Samuel', 'email' => 'Samuel@mail.com'],
            [ 'name' => 'David', 'email' => 'David@mail.com'],
            [ 'name' => 'Clemente', 'email' => 'Clemente@mail.com'],
            [ 'name' => 'Diego', 'email' => 'Diegomail.com'],
            [ 'name' => 'Pablo', 'email' => 'Pablo@mail.com'],
            [ 'name' => 'Claudio', 'email' => 'Claudio@mail.com'],
            [ 'name' => 'Facundo', 'email' => 'Facundo@mail.com'],
            [ 'name' => 'Edgar', 'email' => 'Edgar@mail.com'],
            [ 'name' => 'Enrique', 'email' => 'Enrique@mail.com'],
            [ 'name' => 'Imanol', 'email' => 'Imanol@mail.com'],
            [ 'name' => 'Lucas', 'email' => 'Lucas@mail.com'],
            [ 'name' => 'Uriel', 'email' => 'Uriel@mail.com'],
            [ 'name' => 'Julin', 'email' => 'Julin@mail.com'],
            [ 'name' => 'Gabriel',  'email' => 'Gabriel@mail.com'],
            [ 'name' => 'Luis', 'email' => 'Luis@mail.com'],
            [ 'name' => 'Abel',  'email' => 'Abelmail.com'],
            [ 'name' => 'Jonatan','email' => 'Jonatan@mail.com'],
            [ 'name' => 'Jose', 'email' =>  'Jose@mail.com'],
            [ 'name' => 'Blas', 'email' => 'Blas@mail.com'],
            [ 'name' => 'Álvaro', 'email' => 'Álvaro@mail.com'],
            [ 'name' => 'Agustin', 'email' => 'Agustin@mail.com'],
            [ 'name' => 'Gerard', 'email' => 'Gerard@mail.com'],
            [ 'name' => 'Sebastian', 'email' => 'Sebastian@mail.com'],
            [ 'name' => 'Joaquin',  'email' => 'Joaquin@mail.com'],
            [ 'name' => 'Roman', 'email' => 'Roman@mail.com'],
            [ 'name' => 'Jaime', 'email' => 'Jaime@mail.com'],
            [ 'name' => 'Esteban', 'email' =>  'Esteban@mail.com'],
            [ 'name' => 'Albert',  'email' => 'Albert@mail.com'],
            [ 'name' => 'Ricardo', 'email' => 'Ricardo@mail.com'],
            [ 'name' => 'Patxi', 'email' => 'Patxi@mail.com'],
            [ 'name' => 'Camilo', 'email' => 'Camilo@mail.com'],
            [ 'name' => 'Damian', 'email' => 'Damian@mail.com'],
            [ 'name' => 'Adolfo', 'email' => 'Adolfo@mail.com'],
            [ 'name' => 'Rafael', 'email' => 'Rafael@mail.com'],
            [ 'name' => 'Marcos', 'email' => 'Marcos@mail.com'],
            [ 'name' => 'Javier', 'email' => 'Javier@mail.com'],
            [ 'name' => 'Santos', 'email' => 'Santos@mail.com'],
            [ 'name' => 'Marco', 'email' => 'Marco@mail.com'],
            [ 'name' => 'Cayetano', 'email' => 'Cayetano@mail.com'],
            [ 'name' => 'Rodrigo', 'email' => 'Rodrigo@mail.com'],
            [ 'name' => 'Francisco', 'email' => 'Francisco@mail.com'],
            [ 'name' => 'Flavio',  'email' => 'Flavio@mail.com'],
            [ 'name' => 'Juan', 'email' => 'Juan@mail.com'],
            [ 'name' => 'Andoni', 'email' => 'Andoni@mail.com'],
            [ 'name' => 'Samael', 'email' => 'Samael@mail.com'],
            [ 'name' => 'Martin', 'email' => 'Martin@mail.com'],
            [ 'name' => 'Mario', 'email' => 'Mario@mail.com'],
            [ 'name' => 'Oscar', 'email' => 'Oscar@mail.com'],
            [ 'name' => 'Simon', 'email' => 'Simon@mail.com'],
            [ 'name' => 'Fernando', 'email' => 'Fernando@mail.com'],
            [ 'name' => 'Moises', 'email' => 'Moises@mail.com'],
            [ 'name' => 'Fabian', 'email' => 'Fabian@mail.com'],
            [ 'name' => 'Felix', 'email' => 'Felix@mail.com'],
            [ 'name' => 'Adrian', 'email' => 'Adrian@mail.com'],
            [ 'name' => 'Paco', 'email' => 'Paco@mail.com'],
            [ 'name' => 'Andres', 'email' => 'Andres@mail.com'],
            [ 'name' => 'Jorge', 'email' => 'Jorge@mail.com'],
            [ 'name' => 'Mauricio', 'email' =>  'Mauricio@mail.com'],
            [ 'name' => 'Jairo', 'email' => 'Jairo@mail.com'],
            [ 'name' => 'Arturo', 'email' => 'Arturo@mail.com'],
            [ 'name' => 'Tiago', 'email' => 'Tiago@mail.com'],
            [ 'name' => 'Tomas', 'email' => 'Tomas@mail.com'],
            [ 'name' => 'Gerardo', 'email' => 'Gerardo@mail.com'],
            [ 'name' => 'Sergio', 'email' => 'Sergio@mail.com'],
            [ 'name' => 'Borja', 'email' => 'Borja@mail.com'],
            [ 'name' => 'Fabio', 'email' => 'Fabio@mail.com'],
            [ 'name' => 'Matias', 'email' => 'Matias@mail.com'],
            [ 'name' => 'Iker',  'email' => 'Iker@mail.com'],
            [ 'name' => 'Cristobal', 'email' => 'Cristobal@mail.com'],
            [ 'name' => 'Santiago', 'email' => 'Santiago@mail.com'],
            [ 'name' => 'Humberto', 'email' => 'Humbertohumberto@gmail.com' ],
        ];
        DB::beginTransaction();
        foreach ($users as $value) 
        {
            $user = User::create([
                'name' => $value['name'],
                'email' => $value['email'],
                'email_verified_at' => now(),
                'code' => (string) Str::uuid(),
                'password' => Hash::make('123456'),
                'remember_token' => Str::random(10),
            ]);
            Balance::create([
                'user_id' => $user->id,
                'balance' => 100.00
            ]);

        }
        DB::commit();
    }
}





