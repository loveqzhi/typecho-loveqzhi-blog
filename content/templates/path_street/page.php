<?php 
/*
* 自建页面模板
*/
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div id="timeline" class="horizontal"></div>
<section id="content" class="post_content">
	<div class="post_item">
	<div class="post">
		<article>
		<header>
			<h1><?php topflg($top); ?><?php echo $log_title; ?></h1>
		</header>
		<div class="con">
			<?php echo $log_content; ?>
			<?php doAction('log_related', $logData); ?>
		</div>
		</article>
		<div class="post_comment">
		<?php blog_comments($comments); ?>
	    <?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
		</div>
	</div>
	<div class="post_bottom">
			<time><?php echo gmdate('Y-n-j', $date); ?> </time> | <?php echo $comnum ?>个评论
			<span class="premalink">
				
			</span>
	</div>
	</div>
<?php
 include View::getView('footer');
?>