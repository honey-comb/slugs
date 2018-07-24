<?php

declare(strict_types = 1);

namespace HoneyComb\Slugs\Repositories;

use HoneyComb\Starter\Repositories\Traits\HCQueryBuilderTrait;
use HoneyComb\Slugs\Models\HCSlug;
use HoneyComb\Starter\Repositories\HCBaseRepository;
use Illuminate\Http\Request;


/**
 * Class HCSlugRepository
 * @package HoneyComb\Slugs\Repositories
 */
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

    public function getOptions(Request $request)
    {
        return optimizeTranslationOptions($this->createBuilderQuery($request)->get());
    }
}