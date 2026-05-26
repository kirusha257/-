<?php

namespace App\Http\Controllers;

use App\Models\MenuImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
    // Загрузка изображения для меню
    public function uploadMenuImage(Request $request, $category)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max
        ]);

        $file = $request->file('image');
        $originalName = $file->getClientOriginalName();
        $path = $file->store('menu', 'public'); // сохраняется в storage/app/public/menu

        // Обновляем или создаём запись
        MenuImage::updateOrCreate(
            ['category' => $category],
            [
                'image_url' => '/storage/' . $path,
                'original_filename' => $originalName
            ]
        );

        return back()->with('success', 'Изображение загружено!');
    }

    // Удаление изображения
    public function deleteMenuImage($category)
    {
        $menuImage = MenuImage::where('category', $category)->first();
        
        if ($menuImage) {
            // Удаляем файл
            $path = str_replace('/storage/', '', $menuImage->image_url);
            Storage::disk('public')->delete($path);
            
            // Удаляем запись
            $menuImage->delete();
        }
        
        return back()->with('success', 'Изображение удалено');
    }
}