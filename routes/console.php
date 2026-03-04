<?php

use App\Services\WhapiService;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('whapi:test {phone} {message}', function (WhapiService $whapi) {
    $phone = $this->argument('phone');
    $message = $this->argument('message');

    $this->info("Sending message to $phone...");
    $result = $whapi->sendMessage($phone, $message);

    if ($result) {
        $this->info("Message sent successfully!");
        $this->line(json_encode($result, JSON_PRETTY_PRINT));
    } else {
        $this->error("Failed to send message. Check logs.");
    }
})->purpose('Test Whapi message sending');
