<?php

require_once 'vendor/autoload.php';

// Load Laravel's bootstrap
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Batch;

// Enable query log
DB::enableQueryLog();

// Execute a simple batch query
$batches = Batch::limit(1)->get();

// Get the last query
$queries = DB::getQueryLog();
$lastQuery = end($queries);

echo "Last query executed:\n";
echo $lastQuery['query'] . "\n";
echo "Bindings: " . json_encode($lastQuery['bindings']) . "\n";