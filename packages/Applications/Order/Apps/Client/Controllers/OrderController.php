<?php
namespace Order\Apps\Client\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Order\Models\User;
class OrderController extends Controller
{
	public function index(Request $request)
	{
		$user = User::with('orders')->find(\Auth::id());
		return view('OrderView::client.orders.index',compact('user'));
	}
}
?>