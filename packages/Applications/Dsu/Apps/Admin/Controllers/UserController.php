<?php

namespace Dsu\Apps\admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return view("DsuView::admin.user.index");
    }
}