<?php 
/*
* 碎语部分
*/
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div id="timeline" class="horizontal"></div>
<section id="content" class="post_content">
<div class="post">
<div class="post_comment">
<div id="tw">
    <?php if(ROLE == 'admin' || ROLE == 'writer'): ?>
    <div class="top"><a href="<?php echo BLOG_URL . 'admin/twitter.php' ?>">发布碎语</a></div>
    <?php endif; ?>
	<div id="comments">
	<a name="comments"></a>
	<h4>零碎点滴：</h4>
	</div>
    <ul>
    <?php 
    foreach($tws as $val):
    $author = $user_cache[$val['author']]['name'];
    $avatar = empty($user_cache[$val['author']]['avatar']) ? 
                BLOG_URL . 'admin/views/images/avatar.jpg' : 
                BLOG_URL . $user_cache[$val['author']]['avatar'];
    $tid = (int)$val['id'];
    $img = empty($val['img']) ? "" : '<a title="查看图片" href="'.BLOG_URL.str_replace('thum-', '', $val['img']).'" target="_blank"><img style="border: 1px solid #EFEFEF;" src="'.BLOG_URL.$val['img'].'"/></a>';
    ?>
	<ol class="comment-list">
		<li class="comments">
		<div class="comment-author">
			<img class="avatar" src="<?php echo $avatar; ?>" alt="" width="48" height="48">
		</div>
		<div class="comment-meta">
			<cite class="fn">
				<?php echo $author; ?>
			</cite>		
			<span><?php echo $val['date'];?></span>
			<a class="comment-reply" href="javascript:loadr('<?php echo DYNAMIC_BLOGURL; ?>?action=getr&tid=<?php echo $tid;?>','<?php echo $tid;?>');">回复(<span id="rn_<?php echo $tid;?>"><?php echo $val['replynum'];?></span>)</a><br>
		</div>
		<div class="comment-p">
			<?php echo $val['t'].'<br/>'.$img;?>
		</div>
		<ul id="r_<?php echo $tid;?>" class="r"></ul>
		<div class="huifu" id="rp_<?php echo $tid;?>">
			<textarea id="rtext_<?php echo $tid; ?>"></textarea>
			<div class="tbutton">
				<div class="tinfo" style="display:<?php if(ROLE == 'admin' || ROLE == 'writer'){echo 'none';}?>">
					昵称：<input type="text" id="rname_<?php echo $tid; ?>" value="" />
				<span style="display:<?php if($reply_code == 'n'){echo 'none';}?>">验证码：<input type="text" id="rcode_<?php echo $tid; ?>" value="" /><?php echo $rcode; ?></span>        
				</div>
				<input class="button_p" type="button" onclick="reply('<?php echo DYNAMIC_BLOGURL; ?>index.php?action=reply',<?php echo $tid;?>);" value="回复" /> 
				<div class="msg"><span id="rmsg_<?php echo $tid; ?>" style="color:#FF0000"></span></div>
			</div>
		</div>
		</li>
		<?php endforeach;?>
	</ol>
	<ol class="page-navigator"><?php echo $pageurl;?></ol>
    </ul>
</div>
</div>
</div>
<div class="post_bottom">
		Every Memory Log!
		<span class="premalink">
		</span>
</div>
<?php
 include View::getView('footer');
?>