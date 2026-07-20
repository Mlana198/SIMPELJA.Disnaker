<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class CustomLogoutResponse implements Responsable
{
    public function toResponse($request): Response | RedirectResponse
    {
        return redirect('/');
    }
}
