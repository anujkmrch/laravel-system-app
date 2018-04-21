<?php
namespace Dsu\Apps\Client\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Dsu\Models\User;
use Dsu\Models\CourseApplication;
use SEO;
class ApplicationController extends Controller
{
	public function index(Request $request)
	{
		$user = User::with('applications.course.session','applications.order')->find(\Auth::id());
		SEO::setTitle(trans("DsuLang::seo.application.index.title",['NAME'=>$user->name]));
        SEO::setDescription(trans("DsuLang::seo.application.index.description"));		
		return view('DsuView::client.applications.index',compact('user'));
	}

	public function single(Request $request)
	{
		$app = $request->input('application_id');
		$application = CourseApplication::with('user','course.session','order')->find($app);
		// dd($application->options);
		SEO::setTitle('Application for '.$application->course->title.' in '.$application->course->session->title);

		return view('DsuView::client.applications.single',compact('application'));
	}

	public function pay_fees(Request $request)
    {	
        if($application = CourseApplication::with('user','order')->where('user_id',\Auth::id())->find($request->input('application'))){
        	$user = \Order\Models\User::find(\Auth::id());
			$payment = \PaytmWallet::with('receive');
	        $payment->prepare([
	          'order' => $application->order->id,
	          'user' => $application->user->id,
	          'mobile_number' => "1234567890",
	          'email' => $application->user->email,
	          'amount' => 500,
	          'callback_url' => 'http://dev.codebloop.com/payment/status'
	        ]);
	        return $payment->receive();
        }
    }
}
?>