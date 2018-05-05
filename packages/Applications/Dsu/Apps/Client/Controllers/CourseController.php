<?php

namespace Dsu\Apps\Client\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Dsu\Models\Course;
use Dsu\Models\CourseSession;
use Dsu\Models\CourseApplication;
use Dsu\Models\User;

use Order\Models\Cart;
use Order\Models\Order;
use Order\Classes\OrderConfig;

use Softon\Indipay\Facades\Indipay;
use SEO;
class CourseController extends Controller
{
	public function index(Request $request)
	{
		SEO::setTitle(trans("DsuLang::seo.course.index.inactive.title"));
		SEO::setDescription(trans("DsuLang::seo.course.index.inactive.description"));

		if($session = CourseSession::with('courses')->where('active',true)->first()):

			SEO::setTitle(trans("DsuLang::seo.course.index.active.title",['SESSION'=>$session->title]));

			SEO::setDescription(trans("DsuLang::seo.course.index.active.description"));

			return view('DsuView::client.courses.index',compact('session'));
		endif;
	}

	public function course(Request $request,$course)
	{
		if($course = Course::with('session','documents')->findorFail($course))
			{
				SEO::setTitle(trans("DsuLang::seo.course.course.title",['COURSE'=>$course->title,'SESSION'=>$course->session->title]));

				SEO::setDescription(trans("DsuLang::seo.course.course.description",['COURSE'=>$course->title,'SESSION'=>$course->session->title]));

				$user = User::find(\Auth::id());
				$builder = new \System\Classes\Builder(config('dsu.application'));

				// if(config('dsu.max_applied',2) > 0 and 
				// 	$user->course($course)->AppliedinSessions() >= config('dsu.max_applied',2)) {
				// 		return "You have reached limit";
				// 	}

				// if($user->course($course)->hasApplied())
				// {
				// 	return "You'have already applied for this course";
				// }

			   return view('DsuView::client.courses.single',compact('course','builder'));
			}
	}

	// public function course(Request $request, $course)
	// {
	// 	if($course = Course::with('session')->find($course))
	// 	{
	// 		$user = User::find(\Auth::id());

	// 		if($user->course($course)->hasApplied())
	// 		{
	// 			return "You'have already applied for this course";
	// 		}

	// 		if(config('dsu.max_applied',2) > 0 and $user->course($course)->AppliedinSessions() >= config('dsu.max_applied',2))
	// 		{
	// 			return "You have reached limit";
	// 		}

	// 		$apply = ['course_id'=>$course->id,'options'=>'myoptions'];

	// 		//create application id
	// 		$application = new CourseApplication($apply);
	// 		$parameters = [

 //            'key' => 'RDey6p1q',
 //            'txnid' => '12332212233e22',
 //            'surl' => 'http://localhost:8000/paymentsuccess',// this is the name of my route
 //            'furl' => 'http://localhost:8000/paymentfailure',//this is the name of my route
 //            'firstname' => 'massum',
 //            'email' => 'hussainisfreelancer@gmail.com',
 //            'phone' => '8014700382',
 //            'productinfo' => 'room2',
 //            'service_provider' => 'payu_paisa',
 //            'amount' => '100',


 //      ];
	// 		 $order = Indipay::gateway('PayUMoney')->prepare($parameters);
			

	// 		/* All Required Parameters by your Gateway */
      
		      
		      
	// 	     $user->apply()->save($application);
	// 	      // return Indipay::process($order);	
	// 	}
	// 	dd($course);
	// 	if($course = Course::with('session')->find($course))
	// 	{
	// 		return view('DsuView::client.courses.single',compact('course'));
	// 	}
	// }

	public function ipn(Request $request)
	{
		$id = $request->input('ORDERID');
		$order = Order::find($id);

		//check original status of the order
		$keys = ['MID','TXNID','ORDERID','BANKTXNID','TXNAMOUNT','CURRENCY','STATUS','RESPCODE','RESPMSG','TXNDATE','GATEWAYNAME','BANKNAME','PAYMENTMODE','PROMO_CAMP_ID','PROMO_STATUS','PROMO_RESPCODE','CHECKSUMHASH'];

		$info = $request->only($keys);

		if($info['STATUS'] === 'TXN_SUCCESS')
		{
			$order->status = "paid";
		}

		if($order->isDirty())
			$order->save();

		return redirect()->route('order.client.dashboard');

	}

	public function apply(Request $request,$course)
	{
		if($course = Course::with('session')->find($course))
		{
			$user = User::find(\Auth::id());

			if(config('dsu.max_applied',2) > 0 and $user->course($course)->AppliedinSessions() >= config('dsu.max_applied',2))
			{
				event('dsu.client.course.onLimitOver',$course);
				return "You have reached limit";
			}

			if($user->course($course)->hasApplied())
			{
				event('dsu.client.course.onAppliedFailure',$course);
				return "You'have already applied for this course";
			}

			$apply = ['course_id'=>$course->id,'options'=>'myoptions'];

			//create application id
			$application = new CourseApplication($apply);
			$user->apply()->save($application);
			event('dsu.client.course.onAppliedSuccessfully',[$application,$course]);
		}

		// if($course = Course::find($id)) 
		// {

		// 	$user = User::find(2);

		// 	if($user->course($course)->hasApplied())
		// 	{
		// 		return "You'have already applied for this course";
		// 	}

		// 	if($user->course($course)->AppliedinSessions() >= config('dsu.max_applied',2))
		// 	{
		// 		return "You have reached limit";
		// 	}

		// 	$apply = ['course_id'=>$course->id,'options'=>'myoptions'];
		// 	$application = new CourseApplication($apply);
		// 	$user->apply()->save($application);
		// }
	}


	public function fetch(Request $request)
	{
		$keys = array_keys(config('dsu.application',[]));
		$order_type = "Default";
		if($request->has('course_id'))
			$course_id = $request->input('course_id');

		if($request->has('order_type'))
			$order_type = $request->input('order_type');

		if(count($keys)):
			// array_unshift($keys, 'course_id');
			$rules = [
				'name' =>  "required",
				'dob' =>  "required|date",
				'gender' =>  "required",
				'mother_tongue' =>  "required",
				'nationality' =>  "required",
				'religion' =>  "required",
				'category' =>  "required",
				'address_1' =>  "required",
				'city' =>  "required",
				'state' =>  "required",
				'country' =>  "required",
				'govt_id' =>  "required",
				'govt_id_number' =>  "required",
				'present_address' =>  "required",
				'residence_phone' =>  "",
				'father_name' =>  "required",
				'father_profession' =>  "required",
				'father_qualification' =>  "required",
				'office_address_father' => "required",
				'office_phone_father' =>  "required",
				'mobile_phone_father' =>  "required",
				'mother_name' =>  "required",
				'mother_profession' =>  "required",
				'mother_qualification' =>  "required",
				'office_address_mother' =>  "required",
				'office_phone_mother' => "required",
				'mobile_phone_mother' => "required",
				'examination_center' => "required|array|min:2|max:3",
			];

			$validator = \Validator::make($request->all(),$rules);
			if($validator->fails()){
				// dd($validator->errors());
				return redirect()->back()->withInput($request->input())->withErrors($validator);
				// dd($validation->errors());
			}
			$items = $request->only($keys);
			
			$course = Course::with('session')->find($course_id);
			$user = User::find(\Auth::id());

			if(config('dsu.max_applied',2) > 0 and $user->course($course)->AppliedinSessions() >= config('dsu.max_applied',2))
			{
				event('dsu.client.course.onLimitOver',$course);
				return "You have reached limit";
			}

			if($user->course($course)->hasApplied())
			{
				event('dsu.client.course.onAppliedFailure',$course);
				return "You'have already applied for this course";
			}

			// $apply = ['course_id'=>$course_id,'order_id'=>"0",'options'=>json_encode($items)];

			$apply = ['course_id'=>$course_id,'order_id'=>"0",'options'=>$items];

			$application = new CourseApplication($apply);
			
			$application = $user->apply()->save($application);
			
			$oldCart = \Session::has('cart') ? \Session::get('cart') : null;

	        $cart = new Cart();
	        $cart->add($application,1);

	        $payment_methods=OrderConfig::getConfig('payment_method');

	        $default_method=OrderConfig::getConfig('default_payment_method');
            
            $order = new Order();
            $order->type = $order_type;
            $order->cart = $cart;
            $order->user_id = $user->id;
            $order->address= $user->name;
            $order->name = $user->name;
            $order->key = uniqid();
            $order->payment_method = $default_method;

            $order->save();
            $application->order_id = $order->id;
            $application->save();
            
            event('dsu.client.course.onAppliedSuccessfully',$application);
            
            $return = (event('order.client.order.onOrderMappedSuccessfully',$order));
            //we have some event to
            foreach($return as $r)
            	if(!is_object($r))
            		return $r;

            return redirect()->route('dsu.client.application.index');
		endif;
	}
}
?>