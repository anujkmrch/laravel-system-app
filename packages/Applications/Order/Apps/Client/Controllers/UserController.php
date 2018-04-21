<?php
namespace Dsu\Apps\Client\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Dsu\Models\Course;
use Dsu\Models\CourseSession;
use Dsu\Models\CourseApplication;
use Dsu\Models\User;

class UserController extends Controller
{
	public function index(Request $request)
	{
		return view('DsuView::client.user.index');
	}

	public function edit(Request $request)
	{
		return view('DsuView::client.user.edit');
	}

	public function update(Request $request)
	{
		return view('DsuView::client.user.index');
	}
}
?>