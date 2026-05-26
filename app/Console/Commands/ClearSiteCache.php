<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class ClearSiteCache extends Command
{
    protected $signature = 'cache:clear-site';
    protected $description = 'Очистка всего кэша сайта';
    
    public function handle()
    {
        Cache::flush();
        $this->info('Весь кэш сайта очищен!');
    }
}