<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\HeaderMenuItem;

// For Header 1
$marketplace1 = HeaderMenuItem::where('id', 5)->first();
$article1 = HeaderMenuItem::where('id', 7)->first();
$ai1 = HeaderMenuItem::where('id', 6)->first();

if ($marketplace1 && $article1 && $ai1) {
    $article1->update(['order' => 5]);
    $marketplace1->update(['order' => 6]);
    $ai1->update(['order' => 7]);
}

// For Header 2
$marketplace2 = HeaderMenuItem::where('id', 13)->first();
$article2 = HeaderMenuItem::where('id', 14)->first();

if ($marketplace2 && $article2) {
    $article2->update(['order' => 6]);
    $marketplace2->update(['order' => 7]);
}

echo "Updated menu orders successfully.\n";
