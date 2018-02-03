<?php

declare(strict_types = 1);

namespace HoneyComb\Slugs\Services;

use HoneyComb\Slugs\Repositories\HCSlugRepository;

class HCSlugService
{
    /**
     * @var HCSlugRepository
     */
    private $repository;

    /**
     * HCSlugService constructor.
     * @param HCSlugRepository $repository
     */
    public function __construct(HCSlugRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return HCSlugRepository
     */
    public function getRepository(): HCSlugRepository
    {
        return $this->repository;
    }
}