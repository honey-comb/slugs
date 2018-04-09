<?php
/**
 * @copyright 2018 interactivesolutions
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 * Contact InteractiveSolutions:
 * E-mail: hello@interactivesolutions.lt
 * http://www.interactivesolutions.lt
 */

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

/**
 * Class HCSlugController
 * @package HoneyComb\Slugs\Http\Controllers\Admin
 */
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

    /**
     * Create data list
     * @param Request $request
     * @return JsonResponse
     */
    public function getOptions(Request $request): JsonResponse
    {
        return response()->json(
            $this->service->getRepository()->getOptions($request)
        );
    }

}