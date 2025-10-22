<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            CarreraSeeder::class,
            PlanEstudioSeeder::class,
            NivelSeeder::class,
            TipoSeeder::class,
            MateriaSeeder::class,
            PrerequisitoSeeder::class,
            DocenteSeeder::class,
            EstudianteSeeder::class,
            GestionSeeder::class,
            ModuloSeeder::class,
            GrupoSeeder::class,
            HorarioSeeder::class,
            InscripcionSeeder::class,
            GrupoEstudianteSeeder::class,
            HistorialSeeder::class,
        ]);
    }
}
