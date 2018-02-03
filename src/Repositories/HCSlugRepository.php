<?php

declare(strict_types = 1);

namespace HoneyComb\Slugs\Repositories;

use HoneyComb\Slugs\Models\HCSlug;
use HoneyComb\Core\Repositories\Traits\HCQueryBuilderTrait;
use HoneyComb\Starter\Repositories\HCBaseRepository;

class HCSlugRepository extends HCBaseRepository
{
    use HCQueryBuilderTrait;

    /**
     * @return string
     */
    public function model(): string
    {
        return HCSlug::class;
    }
}