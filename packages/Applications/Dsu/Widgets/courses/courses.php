<?php
	$c = ['course_session_id' => [
			'title' => 'Session',
		   	'type' => 'select',
		   	'scope' => 'configuration', //{column, relation, configuration}//
		   	'callback' => 'dsvv_extract_course_session_list',
		],

		'per_row_only' => [
			'title' => 'Per row',
		   	'type' => 'select',
		   	'scope' => 'configuration', //{column, relation, configuration}//
		   	'callback' => 'widget_true_false_options',
		   	'required'  => true,
		],
	];
?>
	<?php
use Dsu\Models\CourseSession;

$session = CourseSession::with('courses')->find($widget->getConfiguration('course_session_id',0));
?>
<?php
if($widget->hasConfiguration('show_title') and $widget->getConfiguration('show_title',false) == true):	?>
	<h1><?php echo $widget->title.' for '.$session->title;  ?></h1>
<?php endif; ?>
<?php if($widget->getConfiguration('per_row_only',0)==1): ?>
	<div class="row">
<?php endif; ?>

<?php if($session->courses->count()): ?>
	<ul class="marked-list list-unstyled">
	<?php foreach($session->courses as $course): ?>
		<li><a href="<?php echo route('dsu.client.course.course',['id'=>$course->id]) ?>"><?php echo $course->title ?></a></li>
	<?php endforeach; ?>
	</ul>
<?php endif; ?>

<?php if($widget->getConfiguration('per_row_only',0)==1): ?>
	</div>
<?php endif; ?>
