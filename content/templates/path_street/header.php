<?php
/*
Template Name:path_street(轻-街景)
Description:轻系列模板——街景。原作者Cho。
Version:1.3
Author:LaoLuo
Author Url:http://blog.11ri.net
Sidebar Amount:1
ForEmlog:5.3.0
*/
if(!defined('EMLOG_ROOT')) {exit('error!');}
require_once View::getView('module');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $site_title; ?></title>
<meta name="keywords" content="<?php echo $site_key; ?>" />
<meta name="description" content="<?php echo $site_description; ?>" />
<meta name="generator" content="emlog" />
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php echo BLOG_URL; ?>xmlrpc.php?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="<?php echo BLOG_URL; ?>wlwmanifest.xml" />
<link rel="alternate" type="application/rss+xml" title="RSS"  href="<?php echo BLOG_URL; ?>rss.php" />
<link href="<?php echo TEMPLATE_URL; ?>style.css" rel="stylesheet" media="all" type="text/css" />
<script src="<?php echo BLOG_URL; ?>include/lib/js/common_tpl.js" type="text/javascript"></script>
<script type="text/javascript" src="http://t.papaapp.com/js/libs/jquery/1.7.2/jquery.js"></script>
<script src="http://x.papaapp.com/farm1/a571d2/fba453c2/base.js"></script>
<link href='http://fonts.useso.com/css?family=Source+Sans+Pro:200,300,700,900' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="http://x.papaapp.com/farm1/2893f5/e02c9018/jquery.backstretch.min.js"></script>
<link href="<?php echo BLOG_URL; ?>admin/editor/plugins/code/prettify.css" rel="stylesheet" type="text/css" />
<script src="<?php echo BLOG_URL; ?>admin/editor/plugins/code/prettify.js" type="text/javascript"></script>
<script type="text/javascript"> 
$.backstretch("<?php echo TEMPLATE_URL; ?>images/bg.jpg", {speed: 150});
//背景图『大阪-夜色』: http://53hao.lofter.com/post/2711_37210c
</script>
<?php doAction('index_head'); ?>
<!--[if lt IE 9]>
<script src="http://x.papaapp.com/farm1/1484d5/69431f1e/93D6C.js"></script>
<![endif]-->
</head>
<body>
<div class="clear_bg"></div>
<div class="body-inner">
	<div id="header">
		<header id="blog_title">
			<img src="<?php echo TEMPLATE_URL; ?>images/logo.png">
			<h1><a href="<?php echo BLOG_URL; ?>"><?php echo $blogname; ?></a></h1>
			<span class="des">BLOG&PAGE</span>
        </header>
			<nav id="menu"><?php blog_navi();?></nav>
			<form action="<?php echo BLOG_URL; ?>index.php" class="head-search" method="get">
				<input id="search-input" type="text" name="keyword" class="inputbox" value="搜索..." onfocus="if (value =='搜索...'){value =''}" onblur="if (value ==''){value='搜索...'}" x-webkit-speech lang="zh-CN" />
			</form>
		<div class="clear"></div>
    </div>
<div id="wrap">