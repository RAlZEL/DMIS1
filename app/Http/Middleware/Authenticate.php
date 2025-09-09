<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;


class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            // return route('login');
            if($request->routeIs('user.*')) {
                session()->flash('fail','You must sign in first');
                return route('user.login',['fail'=>true,'returnURL'=>URL::current()]);
            }
            if($request->routeIs('mail.*')) {
                session()->flash('fail','You must sign in first');
                return route('user.login',['fail'=>true,'returnURL'=>URL::current()]);
            }
            if($request->routeIs('admin-panel.*')) {
                session()->flash('fail','You must sign in first');
                return route('admin.login',['fail'=>true,'returnURL'=>URL::current()]);
            }
            if($request->routeIs('document-tracking.*')) {
                session()->flash('fail','You must sign in first');
                return route('user.login',['fail'=>true,'returnURL'=>URL::current()]);
            }
            if($request->routeIs('admin.*')) {
                session()->flash('fail','You must sign in first');
                return route('admin.login',['fail'=>true,'returnURL'=>URL::current()]);
            }                 
        }

    }
}
