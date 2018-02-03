<?php

declare(strict_types = 1);

namespace HoneyComb\Slugs\Http\Controllers\Admin;

use HoneyComb\Slugs\Services\HCSlugService;

use HoneyComb\Core\Http\Controllers\HCBaseController;
use HoneyComb\Core\Http\Controllers\Traits\HCAdminListHeaders;
use HoneyComb\Starter\Helpers\HCFrontendResponse;
use Illuminate\Database\Connection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HCSlugController extends HCBaseController
{
    use HCAdminListHeaders;

    /**
     * @var HCSlugService
     */
    protected $service;

    /**
     * @var Connection
     */
    private $connection;

    /**
     * @var HCFrontendResponse
     */
    private $response;

    /**
     * HCSlugController constructor.
     * @param Connection $connection
     * @param HCFrontendResponse $response
     * @param HCSlugService $service
     */
    public function __construct(Connection $connection, HCFrontendResponse $response, HCSlugService $service)
    {
        $this->connection = $connection;
        $this->response = $response;
        $this->service = $service;
    }

    /**
     * Admin panel page view
     *
     * @return View
     */
    public function index(): View
    {
        $config = [
            'title' => trans('HCSlugs::slug.page_title'),
            'url' => route('admin.api.slug'),
            'form' => route('admin.api.form-manager', ['slug']),
            'headers' => $this->getTableColumns(),
            'actions' => $this->getActions('honey_comb_slugs_slug'),
        ];

        return view('HCCore::admin.service.index', ['config' => $config]);
    }

    /**
     * Get admin page table columns settings
     *
     * @return array
     */
    public function getTableColumns(): array
    {
        $columns = [
            'path' => $this->headerText(trans('HCSlugs::slug.path')),
            'slug' => $this->headerText(trans('HCSlugs::slug.slug')),
            'slug_count' => $this->headerText(trans('HCSlugs::slug.slug_count')),
        ];

        return $columns;
    }

    /**
     * Creating data list
     * @param Request $request
     * @return JsonResponse
     */
    public function getListPaginate(Request $request): JsonResponse
    {
        return response()->json(
            $this->service->getRepository()->getListPaginate($request)
        );
    }


}