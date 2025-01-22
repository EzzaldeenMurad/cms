<?php

namespace App\Repositories;

use App\Models\page;
use App\Repositories\Contracts\RepositoryInterface;

class PageRepository implements RepositoryInterface
{
    private $page;

    public function __construct(Page $page)
    {
        $this->page = $page;
    }
    public function all()
    {
        return $this->page->all();
    }

    public function create(array $data)
    {
        return $this->page->create($data);
    }
    public function update(array $data, $id)
    {
        $page =  $this->find($id);
        return $page->update($data);
    }
    public function destroy($id)
    {
        $page = $this->page->find($id);
        return $page->delete();
    }
    public function find($id)
    {
        return $this->page->find($id);
    }
    public function findBySlug($slug)
    {
        return $this->page->whereSlug($slug)->firstOrFail();
    }
}
