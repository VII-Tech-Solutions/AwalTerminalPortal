<?php

namespace App\API\Controllers;

use App\Constants\Attributes;
use App\Constants\Values;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

/**
 * Class CustomController
 * @package App\API\Controllers
 *
 * @OA\Info(title="Awal Private Terminal API", version="1.0")
 */
class CustomController extends BaseController
{
    use ValidatesRequests;

    /** @var Request $request */
    public $request;
    public $page;
    public $limit;
    public $last_update;

    /**
     * Create a new controller instance.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
//        $this->limit = GlobalHelpers::getValueFromHTTPRequest($request, Attributes::LIMIT, Values::ITEMS_PER_PAGE, CastingTypes::INTEGER);
//        $this->page = GlobalHelpers::getValueFromHTTPRequest($request, Attributes::PAGE, 1, CastingTypes::INTEGER);
//        $this->last_update = GlobalHelpers::getValueFromHTTPRequest($request, Attributes::LAST_UPDATE, null, CastingTypes::STRING);
    }

}
