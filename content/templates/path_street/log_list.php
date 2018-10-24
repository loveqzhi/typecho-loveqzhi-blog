<?php 
/*
* 首页日志列表部分
*/
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div id="timeline" class="vertical"></div>
<section id="content">
	<?php doAction('index_loglist_top'); ?>
	<?php foreach($logs as $value): ?>
		<div class="post_item">
		<article class="post">
			<header>
				<h2><?php topflg($value['top']); ?><a href="<?php echo $value['log_url']; ?>"><?php echo $value['log_title']; ?></a></h2>
			</header>
			<div class="con">
				<?php echo ''.subString(strip_tags($value['log_description'],$img),0,200).''; ?>...
			</div>
		</article>
		<div class="post_bottom">
				<time><?php echo gmdate('Y-n-j G:i l', $value['date']); ?></time> | <a rel="nofollow" href="<?php echo $value['log_url']; ?>#comments" title="添加新评论"><?php echo $value['comnum']; ?>个评论</a>
				<span class="premalink">
					<a rel="nofollow" href="<?php echo $value['log_url']; ?>" title="阅读全文「<?php echo $value['log_title']; ?>」">已有<?php echo $value['views']; ?>人围观</a>
				</span>
		</div>
		<div class="post_arrow"></div>
		</div>
		<div class="clear"></div>
		<?php endforeach; ?>
		<ol class="page-navigator">
			<?php echo $page_url;?>
		</ol>
<?php
 include View::getView('footer');
?>