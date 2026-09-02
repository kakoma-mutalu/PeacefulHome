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
        $publicServices = [
            ['name'=>'Alcohol & Drug Addiction Treatment','category'=>'Recovery Support','duration_label'=>'Subject to assessment','price'=>0,'audience'=>'Individuals seeking structured support with alcohol or drug use.','description'=>'Supportive, individualised rehabilitation care focused on recovery, healthy routines and practical next steps.','involves'=>'Assessment, structured routines, counselling and recovery-focused support.','benefits'=>'May help clients build stability, insight and a sustainable recovery plan.'],
            ['name'=>'Mental Health Support','category'=>'Wellbeing','duration_label'=>'Subject to assessment','price'=>0,'audience'=>'Individuals needing compassionate mental health and wellbeing support.','description'=>'A safe space for appropriate support, monitoring and referral-led care where needed.','involves'=>'An initial conversation, assessment and personalised support planning.','benefits'=>'May support emotional wellbeing and healthy coping strategies.'],
            ['name'=>'Behavioral Therapy','category'=>'Therapy','duration_label'=>'Subject to assessment','price'=>0,'audience'=>'People working to understand and change unhelpful patterns.','description'=>'Structured therapeutic support that explores behaviours, triggers and practical coping skills.','involves'=>'Guided conversations, goal setting and progress reviews.','benefits'=>'May help strengthen awareness, routines and healthier choices.'],
            ['name'=>'Relapse Prevention','category'=>'Aftercare','duration_label'=>'Ongoing support','price'=>0,'audience'=>'Clients preparing for or continuing recovery after a programme.','description'=>'Practical planning for triggers, support systems and safe next steps.','involves'=>'Personal relapse-prevention plans and regular reviews.','benefits'=>'May help clients prepare for challenges and maintain connection to support.'],
            ['name'=>'Family Support & Counselling','category'=>'Family Support','duration_label'=>'By arrangement','price'=>0,'audience'=>'Families and loved ones affected by a recovery journey.','description'=>'Respectful guided conversations to improve understanding, boundaries and support.','involves'=>'Family-focused sessions subject to client consent and Peaceful Home policy.','benefits'=>'May help families communicate and support recovery constructively.'],
            ['name'=>'Aftercare & Reintegration','category'=>'Aftercare','duration_label'=>'Ongoing support','price'=>1500,'audience'=>'Clients transitioning from structured rehabilitation to everyday life.','description'=>'Recovery-focused follow-up support for reintegration and maintaining healthy routines.','involves'=>'Check-ins, goal reviews and appropriate referral or family involvement.','benefits'=>'May help clients remain connected to a recovery plan.'],
        ];
        $programmes = [
            ['name'=>'Initial Assessment & Recovery Planning','category'=>'Programme','duration_minutes'=>60,'duration_label'=>'Initial assessment','price'=>750,'description'=>'A structured initial assessment to understand circumstances and help determine an appropriate recovery pathway.'],
            ['name'=>'30-Day Residential Recovery Programme','category'=>'Programme','duration_minutes'=>43200,'duration_label'=>'30 days','price'=>12500,'description'=>'A structured residential programme with accommodation, supervised daily routines, counselling and recovery-focused support.'],
            ['name'=>'60-Day Residential Recovery Programme','category'=>'Programme','duration_minutes'=>86400,'duration_label'=>'60 days','price'=>23000,'description'=>'An extended residential recovery programme allowing time for structured support and progress reviews.'],
            ['name'=>'90-Day Comprehensive Recovery Programme','category'=>'Programme','duration_minutes'=>129600,'duration_label'=>'90 days','price'=>32500,'description'=>'A comprehensive residential programme for clients who may benefit from a longer structured recovery period.'],
        ];
        foreach (array_merge($publicServices, $programmes) as $item) {
            $item += ['slug'=>\Illuminate\Support\Str::slug($item['name']), 'duration_minutes'=>60, 'is_active'=>true, 'is_programme'=>in_array($item['category'], ['Programme'])];
            Service::updateOrCreate(['slug'=>$item['slug']], $item);
        }
        \App\Models\Testimonial::updateOrCreate(['name'=>'Placeholder client feedback'], ['relationship'=>'Development placeholder','quote'=>'The team made space for respectful conversations and helped our family understand the next steps in recovery.','is_placeholder'=>true,'is_active'=>true]);
        \App\Models\Testimonial::updateOrCreate(['name'=>'Placeholder family feedback'], ['relationship'=>'Development placeholder','quote'=>'The structured, calm approach gave us hope and a clearer way to support someone we care about.','is_placeholder'=>true,'is_active'=>true]);
    }
}
