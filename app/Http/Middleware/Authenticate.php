<?php

namespace App\Http\Middleware;

use App\Http\Services\BaseService;
use App\Http\Services\GameUtils;
use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Support\Str;

class Authenticate extends BaseService
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $sign = $request->input('sign', 0);
        $params = str_replace($request->getPathInfo(), '', $request->getRequestUri());
        $params = Str::before($params, '&sign=');
        $isValid = GameUtils::VerifySignData($params, $sign);
        if (!$isValid) {
            $data = self::getJsonFails();
            $data['msg'] = '抱歉，接口签名错误!';
            return $data;
        }


//        if ($this->auth->guard($guard)->guest()) {
//            return response('Unauthorized.', 401);
//        }

        return $next($request);
    }
}
