<?php
namespace App\Support;

use Illuminate\Support\Facades\File;

final class PlaceholderImage
{
    public static function ensure(string $relative, string $label, string $kind = 'image'): string
    {
        $path = public_path($relative);
        if (File::exists($path)) return $relative;
        File::ensureDirectoryExists(dirname($path));
        $safe = htmlspecialchars($label, ENT_QUOTES, 'UTF-8');
        $sub = htmlspecialchars($kind, ENT_QUOTES, 'UTF-8');
        $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 800"><rect width="1200" height="800" fill="#eef7f1"/><circle cx="100" cy="80" r="180" fill="#d7eee0"/><circle cx="1120" cy="720" r="260" fill="#cce8d7"/><path d="M600 150l170 90v180c0 120-75 205-170 250-95-45-170-130-170-250V240z" fill="#087443" opacity=".12"/><path d="M600 200l120 65v145c0 80-48 143-120 181-72-38-120-101-120-181V265z" fill="#087443" opacity=".85"/><text x="600" y="420" text-anchor="middle" font-family="Arial,sans-serif" font-size="42" font-weight="700" fill="white">MWC NU</text><text x="600" y="510" text-anchor="middle" font-family="Arial,sans-serif" font-size="34" font-weight="700" fill="#17352a">'.$safe.'</text><text x="600" y="560" text-anchor="middle" font-family="Arial,sans-serif" font-size="20" fill="#527267">'.$sub.' • Prototype</text></svg>';
        File::put($path, $svg);
        return $relative;
    }
}
