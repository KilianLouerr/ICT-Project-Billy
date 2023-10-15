<?php

namespace App\Repositories\Contracts;

use Carbon\Factory;

interface ManageMediaRepository
{
    public function addMedia(string $mediaName, string $mediaType, string $mediaContent): int;
}
