<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;

use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'Siti Web e Applicazioni Web',
            'Applicazioni Mobile',
            'Progetti di Design Grafico',
            'Progetti di Fotografia e Video',
            'Progetti di Marketing Digitale',
            'Progetti di Programmazione e Sviluppo Software',
            'Progetti di Comunicazione e Relazioni Pubbliche'
        ];

        foreach($types as $element){
            $new_type = new Type();

            $new_type->name = $element;
            $new_type->slug = Str::slug($new_type->name);

            $new_type->save();
        }
    }
}
