<?php 
/*
* 底部信息
*/
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
</section><!--end #content-->
<div style="clear:both;"></div>
<footer id="footer"> 
		<span class="back2top">
		<a rel="nofollow" href="<?php echo BLOG_URL; ?>rss.php" target="_blank">Rss</a> / 
		<a rel="nofollow" href="javascript:void(0);" onclick="MGJS.goTop();return false;">Top</a>
		</span>
		<div class="copy">Copyright &copy;  2010-2013 / Powered by <a href="http://www.emlog.net" title="emlog <?php echo Option::EMLOG_VERSION;?>">emlog</a>
		/ Theme by <a href="http://pagecho.com">cho</a>
		<br>Don't forget transplant by <a href="http://blog.11ri.net">LaoLuo</a>!</br>
		<a href="http://www.miibeian.gov.cn" target="_blank"><?php echo $icp; ?></a> <?php echo $footer_info; ?>
		<?php doAction('index_footer'); ?>
		</div>
</footer>
</div><!--end #wrap-->
<script type="text/javascript" src="http://x.papaapp.com/farm1/775895/a06e3ed2/F61B5.js"></script>
<script type="text/javascript"> 
jQuery('.con a:has(img)').lightBox();
</script> 
<script type="text/javascript">  
    if (top.location !== self.location) {  
      top.location = self.location;  
    }  
</script>
</body>
</html>