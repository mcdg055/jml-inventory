<?php

namespace Modules\System\App\Traits;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;

trait FlashMessage
{
    /**
     * @param Request $request
     * 
     * @param array $data
     * @return array
     */
    function getFlashMessage(Request $request, array $data)
    {
        $inputs = $request->all();
        if ($flash = Arr::get($inputs, "flash")) {
            $data['flash'] = $flash;
        }

        return $data;
    }
}
