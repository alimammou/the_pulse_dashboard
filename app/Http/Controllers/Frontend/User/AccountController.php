<?php

namespace App\Http\Controllers\Frontend\User;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;

/**
 * Class AccountController.
 */
class AccountController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        return view('frontend.user.account');
    }
}
