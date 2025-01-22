<?php

namespace App\Services;

use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\PageRepository;


class PageService
{
    protected PageRepository $pageRepository;
    public function __construct(RepositoryInterface $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }


    public function getAllPages()
    {
        return $this->pageRepository->all();
    }
    public function getPageBySlug($slug)
    {
        return $this->pageRepository->findBySlug($slug);
    }

    public function createPage(array $data)
    {
        return $this->pageRepository->create($data);
    }

    public function updatePage($data, $id)
    {
        return $this->pageRepository->update($data, $id);
    }
    public function getPage($id)
    {
        return $this->pageRepository->find($id);
    }

    public function deletePage($id)
    {
        return $this->pageRepository->destroy($id);
    }
}
