<?php

namespace App\API\Middleware;

use App\Constants\Attributes;
use App\Constants\Languages;
use App\Constants\Messages;
use App\Models\Helpers;
use App\Models\User;
use Closure;
use Dingo\Api\Http\Request;
use Illuminate\Http\Response;
use VIITech\Helpers\GlobalHelpers;

/**
 * Class AllowedUser
 * @package App\API\Middleware
 */
class AllowedUser
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param $public_for_all
     * @return mixed
     */
    public function handle($request, Closure $next, $public_for_all = false)
    {
        // Is allowed user?
        $user = Helpers::getCurrentUser();
        if (!GlobalHelpers::isValidObject($user, User::class) && !$public_for_all) {
            return GlobalHelpers::formattedJSONResponse(__(Messages::PERMISSION_DENIED), null, null, Response::HTTP_UNAUTHORIZED);
        }

        if (GlobalHelpers::isValidObject($user, User::class)) {
            app()->instance(Attributes::USER_ID, $user->id);
            switch ($user->language) {
                case Languages::ENGLISH:
                    app()->setLocale('en');
                    break;
                default:
                    app()->setLocale('ar');
                    break;
            }
        } else {
            // When the user is a guest
            $language = $request->header('Content-Language');
            switch ($language) {
                case 'en':
                    app()->setLocale('en');
                    break;
                default:
                    app()->setLocale('ar');
                    break;
            }
        }
        return $next($request);
    }
}
