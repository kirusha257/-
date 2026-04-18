<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AboutInfo;
use App\Models\Staff;
use App\Models\Review;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        AboutInfo::create([
            'content' => 'Ресторан «AAA» — это сочетание изысканной кухни, уютной атмосферы и традиций гостеприимства. Открыв свои двери в 2015 году, мы стремимся дарить гостям незабываемые вечера. Наша философия — только свежие продукты, авторский подход к классическим рецептам и душевный сервис. «AAA» — место, где каждый чувствует себя особенным.'
        ]);

        Staff::create(['name' => 'Алексей Гурьев', 'position' => 'Шеф-повар', 'photo_url' => '/storage/staff/chef.jpg', 'sort_order' => 1]);
        Staff::create(['name' => 'Мария Сомова', 'position' => 'Сомелье', 'photo_url' => '/storage/staff/sommelier.jpg', 'sort_order' => 2]);
        Staff::create(['name' => 'Дмитрий Волков', 'position' => 'Ресторанный менеджер', 'photo_url' => '/storage/staff/manager.jpg', 'sort_order' => 3]);
        Staff::create(['name' => 'Елена Полякова', 'position' => 'Шеф-кондитер', 'photo_url' => '/storage/staff/pastry.jpg', 'sort_order' => 4]);

        Review::create(['author' => 'Анна С.', 'text' => 'Потрясающая атмосфера и обслуживание! Блюда как произведения искусства. Обязательно вернусь.', 'rating' => 5]);
        Review::create(['author' => 'Михаил К.', 'text' => 'Отличная винная карта. Очень уютно, но в пятницу вечером громковато. В остальном великолепно!', 'rating' => 4]);
        Review::create(['author' => 'Елена В.', 'text' => 'Лучший ресторан в городе! Десерты выше всяких похвал, персонал внимательный. Рекомендую!', 'rating' => 5]);
        Review::create(['author' => 'Олег М.', 'text' => 'Заказывал столик на день рождения — всё прошло идеально, комплимент от шефа приятно удивил.', 'rating' => 5]);
    }
}