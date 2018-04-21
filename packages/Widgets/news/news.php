<?php

$news = \News\Models\News::orderBy('created_at','desc')
                ->limit(5)
                ->get();
if($widget->hasConfiguration('show_title') and $widget->getConfiguration('show_title',false) == true): ?>
	<h1><?php echo $widget->title; ?></h1>
<?php endif; ?>
<?php if($widget->getConfiguration('per_row_only',0)==1): ?>
	<div class="row">
<?php endif; ?>

<?php if($widget->getConfiguration('per_row_only',0)==1): ?>
	</div>
<?php endif; ?>
<a href="<?php echo route('news.client.news.all') ?>">View all ></a>
<?php if($news->count()): ?>
	<ul class="marked-list list-unstyled">
	<?php foreach($news as $item): ?>
		<?php if($item->hasConfiguration('linked') and $item->getConfiguration('linked',false)): ?>
			<li><a href="<?php echo $item->getConfiguration('link'); ?>"><?php echo $item->title ?></a></li>
		<?php else: ?>
			<li><a href="<?php echo route('news.client.news.news',['id'=>$item->id]) ?>"><?php echo $item->title ?></a></li>
		<?php endif; ?>
	<?php endforeach; ?>
	</ul>
<?php endif; ?>