<?php

namespace App\Repositories\Eloquent;

use App\Models\Media;
use App\Repositories\Contracts\ManageMediaRepository;

class EloquentMedia implements ManageMediaRepository
{
    private Media $mediaModel;

    public function __construct(Media $mediaModel)
    {
        $this->mediaModel = $mediaModel;
    }

    public function addMedia(string $mediaName, string $mediaType, string $mediaContent): int
    {
        $this->mediaModel = Media::create([
            'name' => $mediaName,
            'type' => $mediaType,
            'content' => $mediaContent,
        ]);

        return $this->mediaModel->id;
    }
}
