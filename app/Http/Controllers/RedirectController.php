<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function support(Request $request)
    {
        return $this->handleRedirectTo($request, config('discord.support-url'));
    }

    public function invite(Request $request)
    {
        return $this->handleRedirectTo($request, config('discord.invite-url'));
    }

    protected function handleRedirectTo(Request $request, $url)
    {
        if ($request->has('raw') && $request->get('raw') == 'yes') {
            return $url;
        }
        return redirect($url);
    }
}
