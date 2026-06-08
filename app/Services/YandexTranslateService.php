<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class YandexTranslateService
{
    public function translate(?string $text): string
{
    if (empty($text)) {
        return '';
    }

    $response = Http::withHeaders([
        'Authorization' => 'Api-Key ' . env('YANDEX_TRANSLATE_API_KEY'),
    ])->post(
        'https://translate.api.cloud.yandex.net/translate/v2/translate',
        [
            'folderId' => env('YANDEX_FOLDER_ID'),
            'texts' => [$text],
            'sourceLanguageCode' => 'ru',
            'targetLanguageCode' => 'en',
        ]
    );

    return $response->json('translations.0.text') ?? '';
}
}