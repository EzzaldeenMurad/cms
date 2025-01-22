<?php

namespace App\Repositories\Contracts;

interface PostRepositoryInterface extends RepositoryInterface
{
    public function getByCategory($categoryId);
    public function search($query);
}
