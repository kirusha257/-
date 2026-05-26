<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // О нас
        DB::table('about_infos')->insert([
            'content' => 'Ресторан «AAA» — это сочетание изысканной кухни, уютной атмосферы и традиций гостеприимства. Открыв свои двери в 2015 году, мы стремимся дарить гостям незабываемые вечера.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // Контакты
        DB::table('contacts')->insert([
            'address' => 'ул. Тверская, 10, Москва',
            'phone' => '+7 (495) 123-45-67',
            'email' => 'info@aaa-restaurant.ru',
            'work_hours' => 'Пн–Вс: 12:00 – 00:00',
            'map_coordinates' => '55.7579,37.6156',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // Соцсети
        DB::table('social_links')->insert([
            ['platform' => 'telegram', 'url' => 'https://t.me/aaa_restaurant', 'created_at' => now(), 'updated_at' => now()],
            ['platform' => 'vk', 'url' => 'https://vk.com/aaa_restaurant', 'created_at' => now(), 'updated_at' => now()],
        ]);
        
        // Настройки сайта
        DB::table('site_settings')->insert([
            'footer_text' => '© 2025 Ресторан AAA — изысканная классика',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}