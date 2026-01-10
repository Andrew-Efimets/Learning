<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Schedule;
use App\Models\Product;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function () {
    $expiredProducts = Product::where('status', 1)
        ->where('updated_at', '<', now()->subMinutes(6))
        ->get();

    if ($expiredProducts->isNotEmpty()) {
        Product::whereIn('id', $expiredProducts->pluck('id'))
            ->update(['status' => 0]);

        Cache::flush();
    }
})->everyFiveMinutes();



Schedule::call(function () {
    $db = config('database.connections.mysql');
    $date = now()->format('Y-m-d_H-i');
    $filename = "backups/db_dump_{$date}.sql";
    $fullPath = storage_path("app/{$filename}");

    $result = Process::run([
        '/usr/bin/mariadb-dump',
        '--host=' . $db['host'],
        '--user=' . $db['username'],
        '--password=' . $db['password'],
        '--skip-ssl',
        $db['database']
    ]);

    if ($result->successful() && strlen($result->output()) > 0) {
        if (!is_dir(dirname($fullPath))) {
            mkdir(dirname($fullPath), 0777, true);
        }

        file_put_contents($fullPath, $result->output());
        chmod($fullPath, 0666);
        clearstatcache(true, $fullPath);
        $exists = file_exists($fullPath) ? 'ДА' : 'НЕТ';
        $realSize = $exists === 'ДА' ? filesize($fullPath) : 0;

        logger()->info("- Путь: $fullPath");
        logger()->info("- PHP видит файл: $exists");
        logger()->info("- Размер на диске: $realSize байт");
    } else {
        logger()->error("Дамп не удался или пуст. Код: " . $result->exitCode());
    }
})->everyThirtyMinutes();
