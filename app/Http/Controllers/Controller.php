<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function jsonResponse($errcode = 0, $errmsg = '', $others = [])
    {
        $json = array_merge($others, ['errcode' => $errcode, 'errmsg' => $errmsg]);
        return response()->json($json);
    }

    protected function jsonSuccess($others = [])
    {
        return $this->jsonResponse(0, '', $others);
    }
}
