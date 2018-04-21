<?php
namespace Dsu\Apps\Client\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Dsu\Models\Course;
use Dsu\Models\CourseSession;
use Dsu\Models\CourseApplication;
use Dsu\Models\User;
use SEO;
class DsuController extends Controller
{
	public function index(Request $request)
	{
		SEO::setTitle(trans("DsuLang::seo.dsu.index.title"));
        SEO::setDescription(trans("DsuLang::seo.dsu.index.description"));
		
		return view('DsuView::client.dsu.index');
	}
}
?>