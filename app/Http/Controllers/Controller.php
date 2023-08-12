<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /************************************************************************
    *API Response for 400 error
    *************************************************************************/
    public function api400($errors = null)
    {
        return response()->json([
            'message' => $errors,
            'data' => [],
        ])->setStatusCode(400);
    }

    /************************************************************************
    *API Response for 201 success
    *************************************************************************/
    public function api201($data = null)
    {
        return response()->json([
            'message' => 'Success.',
            'data' => $data == null ? [] : $data,
        ])->setStatusCode(201);
    }

    /************************************************************************
    *Web Response for validator error
    *************************************************************************/
    public function webError($errors)
    {
        return redirect()->back()->withErrors($errors)->withInput();
    }
}
