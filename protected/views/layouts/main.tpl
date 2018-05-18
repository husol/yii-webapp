<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en,vi" />
    <meta name="title" content="<{$Hus->cHtmlEncode($this->pageTitle)}>" />
    <meta name="description" content="Đoàn thanh niên huyện Trảng Bàng" />
    <link rel="stylesheet" type="text/css" href="<{HUS::getBaseUrl()}>css/form.css" />

    <title><{$Hus->cHtmlEncode($this->pageTitle)}></title>
    <link rel="shortcut icon" href="<{HUS::getBaseUrl()}>img/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="<{HUS::getBaseUrl()}>css/style.css" />
    <link rel="stylesheet" type="text/css" href="<{HUS::getBaseUrl()}>js/jquery/jquery.ui.all.css" />
    <link rel="stylesheet" type="text/css" href="<{HUS::getBaseUrl()}>js/jquery/tipsy/css/tipsy.css" />
    <link rel="stylesheet" type="text/css" href="<{HUS::getBaseUrl()}>js/jquery/bvalidator/css/bvalidator.css" />
    <link rel="stylesheet" type="text/css" href="<{HUS::getBaseUrl()}>js/jquery/tablesorter/css/tablesorter.css" />
    <link rel="stylesheet" type="text/css" href="<{HUS::getBaseUrl()}>js/jquery/tablesorter/css/tablesorter.pager.css" />
    <link rel="stylesheet" type="text/css" href="<{HUS::getBaseUrl()}>js/jquery/fancybox/jquery.fancybox-1.3.4.css" />
    <link rel="stylesheet" type="text/css" href="<{HUS::getBaseUrl()}>js/jquery/slides/css/slides.css" />
    <link rel="stylesheet" type="text/css" href="<{HUS::getBaseUrl()}>js/jquery/jcarousellite/css/jcarousellite.css" />
    <script type="text/javascript" src="<{HUS::getBaseUrl()}>js/jquery/jquery-1.8.0.min.js?v=<{$smarty.const.APPLICATION_VERSION}>"></script>
    <script type="text/javascript" src="<{HUS::getBaseUrl()}>js/jquery/fancybox/jquery.fancybox-1.3.4.pack.js?v=<{$smarty.const.APPLICATION_VERSION}>"></script>
    <script type="text/javascript" src="<{HUS::getBaseUrl()}>js/jquery/jquery-ui-1.10.1.custom.min.js?v=<{$smarty.const.APPLICATION_VERSION}>"></script>
    <script type="text/javascript" src="<{HUS::getBaseUrl()}>js/jquery/jquery.ui.widget.js?v=<{$smarty.const.APPLICATION_VERSION}>"></script>
    <script type="text/javascript" src="<{HUS::getBaseUrl()}>js/jquery/jquery.showMessage.min.js?v=<{$smarty.const.APPLICATION_VERSION}>"></script>
    <script type="text/javascript" src="<{HUS::getBaseUrl()}>js/jquery/jquery.cookies.js?v=<{$smarty.const.APPLICATION_VERSION}>"></script>
    <script type="text/javascript" src="<{HUS::getBaseUrl()}>js/jquery/tipsy/jquery.tipsy.js?v=<{$smarty.const.APPLICATION_VERSION}>"></script>
    <script type="text/javascript" src="<{HUS::getBaseUrl()}>js/jquery/bvalidator/jquery.bvalidator.js?v=<{$smarty.const.APPLICATION_VERSION}>"></script>
    <script type="text/javascript" src="<{HUS::getBaseUrl()}>js/jquery/tablesorter/jquery.tablesorter.min.js?v=<{$smarty.const.APPLICATION_VERSION}>"></script>
    <script type="text/javascript" src="<{HUS::getBaseUrl()}>js/jquery/tablesorter/jquery.tablesorter.pager.js?v=<{$smarty.const.APPLICATION_VERSION}>"></script>
    <script type="text/javascript" src="<{HUS::getBaseUrl()}>js/jquery/tablesorter/jquery.tablesorter.widgets.js?v=<{$smarty.const.APPLICATION_VERSION}>"></script>
    <script type="text/javascript" src="<{HUS::getBaseUrl()}>js/jquery/slides/slides.min.jquery.js?v=<{$smarty.const.APPLICATION_VERSION}>"></script>
    <script type="text/javascript" src="<{HUS::getBaseUrl()}>js/jquery/jcarousellite/jcarousellite.js?v=<{$smarty.const.APPLICATION_VERSION}>"></script>
    <script type="text/javascript" src="<{HUS::getBaseUrl()}>js/common.js?v=<{$smarty.const.APPLICATION_VERSION}>"></script>
    <script type="text/javascript" src="<{HUS::getBaseUrl()}>js/paging.js?v=<{$smarty.const.APPLICATION_VERSION}>"></script>
    <script type="text/javascript" src="<{HUS::getBaseUrl()}>ckeditor/ckeditor.js?v=<{$smarty.const.APPLICATION_VERSION}>"></script>
</head>

<body>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-40057597-1', 'huyendoantrangbang.org.vn');
  ga('send', 'pageview');
</script>
<div class="container" id="page">

	<{$content}>

</div><!-- page -->
<a href="#" class="scrollup">Scroll</a>
</body>
</html>
