<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait UploadsImages
{
    /**
     * Загрузить изображение
     * @param UploadedFile $file
     * @param string $folder
     * @return string путь к файлу
     */
    public function uploadImage(UploadedFile $file, string $folder): string
    {
        $path = $file->store($folder, 'public');
        return '/storage/' . $path;
    }
    
    /**
     * Удалить изображение
     * @param string|null $path
     */
    public function deleteImage(?string $path): void
    {
        if (!$path) return;
        
        $relativePath = str_replace('/storage/', '', $path);
        if (Storage::disk('public')->exists($relativePath)) {
            Storage::disk('public')->delete($relativePath);
        }
    }
}