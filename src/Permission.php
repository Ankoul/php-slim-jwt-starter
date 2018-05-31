<?php

namespace com\school\api;


use Slim\Http\Request;
use Slim\Http\Response;

class Permission {

    const SUPER_ADMIN = 1;
    const ADMIN = 2;

    public function __invoke(Request $request, Response $response, $next) {
        $this->needAuth($request, $response, $next);
    }

    public function needAuth(Request $request, Response $response, $next) {
        if($request->getAttribute("token")){
            return $next($request, $response);
        }
        return $this->respondUnauthorized($response);
    }

    public function needSuperAdmin(Request $request, Response $response, $next) {
        return $this->needPerm($request, $response, $next, Permission::SUPER_ADMIN);
    }

    public function needAdmin(Request $request, Response $response, $next) {
        return $this->needPerm($request, $response, $next, Permission::ADMIN);
    }

    public static function hasPerm($permissions, $permission){
        return $permissions && ($permissions & $permission) === $permission;
    }
    public static function addPerm($permissions, $permission){
        return $permissions | $permission;
    }
    public static function removePerm($permissions, $permission){
        return $permissions & (~$permission);
    }

    private function needPerm(Request $request, Response $response, $next, $permission) {
        $token = $request->getAttribute("token");
//        var_dump($token);
        $permissions = $token && isset($token['sub']) ? $token['sub']->permissions : 0;
        if(Permission::hasPerm($permissions, $permission)){
            return $next($request, $response);
        }
        return $this->respondForbidden($response);
    }

    private function respondUnauthorized(Response $response){
        $data['message'] = 'Unauthorized';
        return $response->withJson($data, 401)
            ->withHeader('Content-type', 'application/json');
    }

    private function respondForbidden(Response $response){
        $data['message'] = 'Forbidden';
        return $response->withJson($data, 403)
            ->withHeader('Content-type', 'application/json');
    }

}