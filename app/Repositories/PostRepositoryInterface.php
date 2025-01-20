<?php

namespace App\Repositories;

interface PostRepositoryInterface extends RepositoryInterface
{
    public function show($slug);
    public function getByCategory($categoryId);
    public function search($query);
}
