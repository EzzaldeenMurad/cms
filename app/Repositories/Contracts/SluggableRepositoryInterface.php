<?php

namespace App\Repositories\Contracts;

interface SluggableRepositoryInterface
{
    public function findBySlug($slug);
}
