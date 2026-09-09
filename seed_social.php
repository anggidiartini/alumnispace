<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$profiles = \App\Models\AlumniProfile::all();
foreach($profiles as $p) {
    if (!$p->instagram_url) {
        $name = strtolower(str_replace(' ', '', $p->user->name ?? 'user'));
        $p->instagram_url = "https://instagram.com/" . $name;
    }
    if (!$p->tiktok_url) {
        $name = strtolower(str_replace(' ', '', $p->user->name ?? 'user'));
        $p->tiktok_url = "https://tiktok.com/@" . $name;
    }
    $p->save();
}
echo "Done";
