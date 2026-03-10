<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageUploadService
{
    public const BANNERS = 1920;
    public const EVENTS = 1200;
    public const GALLERIES = 1400;
    public const ARTICLES = 800;
    public const AVATARS = 400;

    protected ImageManager $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
    }

    public function upload(UploadedFile $file, string $directory, int $maxWidth, int $quality = 80): string
    {
        $image = $this->manager->read($file->getPathname());

        if ($image->width() > $maxWidth) {
            $image->scale(width: $maxWidth);
        }

        $filename = uniqid() . '.webp';
        $path = rtrim($directory, '/') . '/' . $filename;

        $encoded = $image->toWebp(quality: $quality);

        Storage::disk('public')->put($path, (string) $encoded);

        return $path;
    }

    public function delete(string $path): bool
    {
        return Storage::disk('public')->delete($path);
    }
}
