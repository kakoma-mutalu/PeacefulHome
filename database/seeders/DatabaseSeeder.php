<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(['email'=>'admin@rehabcare.test'],[
            'name'=>'System Administrator','password'=>Hash::make('password'),'role'=>'SUPER ADMIN','phone'=>'0970000000'
        ]);

        User::updateOrCreate(['email'=>'reception@rehabcare.test'],[
            'name'=>'Reception Officer','password'=>Hash::make('password'),'role'=>'RECEPTION','phone'=>'0970000001'
        ]);

        User::updateOrCreate(['email'=>'clinical@rehabcare.test'],[
            'name'=>'Clinical Officer','password'=>Hash::make('password'),'role'=>'CLINICAL','phone'=>'0970000002'
        ]);

        $services = [
            ['name'=>'Initial Assessment','description'=>'Comprehensive first assessment and recovery planning.','category'=>'Assessment','duration_minutes'=>60,'price'=>350],
            ['name'=>'Individual Counselling','description'=>'One-to-one counselling session with a qualified practitioner.','category'=>'Counselling','duration_minutes'=>60,'price'=>300],
            ['name'=>'Behavioural Therapy','description'=>'Structured behavioural support session.','category'=>'Therapy','duration_minutes'=>60,'price'=>400],
            ['name'=>'Family Support Session','description'=>'Guided family counselling and recovery support.','category'=>'Family Support','duration_minutes'=>90,'price'=>450],
            ['name'=>'Relapse Prevention Session','description'=>'Practical relapse-prevention planning and review.','category'=>'Aftercare','duration_minutes'=>60,'price'=>300],
        ];
        foreach($services as $service){
            Service::updateOrCreate(['slug'=>\Illuminate\Support\Str::slug($service['name'])], $service + ['is_active'=>true,'slug'=>\Illuminate\Support\Str::slug($service['name'])]);
        }
    }
}
