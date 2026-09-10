<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$items = App\Models\HeaderMenuItem::orderBy('order')->get();
foreach($items as $item) {
    echo "ID: {$item->id}, Label: {$item->label}, Order: {$item->order}\n";
}
