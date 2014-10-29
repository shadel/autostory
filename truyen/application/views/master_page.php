<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $contentData['title']; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php foreach ($contentData['meta'] as $key => $meta) { ?>
	<meta name="<?php echo $key;?>" content="<?php echo $meta;?>" />
	<?php }?>

	 <link href="/libs/css/bootstrap.min.css" rel="stylesheet" media="screen" >
	 <link href="/libs/css/custom.css" rel="stylesheet" media="screen" >
	 <script type="text/javascript" src="/libs/js/jquery.min.js" ></script>
	 <script type="text/javascript" src="/libs/js/bootstrap.min.js" ></script>
	 <script type="text/javascript" src="/libs/js/tab.js" ></script>
	 <script type="text/javascript" src="/libs/js/jquery.cookie.js" ></script>
	 <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-19534365-20', 'auto');
  ga('send', 'pageview');

</script>
</head>
<body>
	<div class="container">
		<div class="row"  id="header">
		 	<div class="page-header">
		  		<a href="<?php echo $home; ?>"><h1>TuyetBut<small>.com</small></h1></a>
			</div>
		</div>
		<div class="row" >
		<?php $this->load->view($category, $categoryData); ?>
		<?php $this->load->view($content, $contentData); ?>
		<?php $this->load->view($sidebar, $sidebarData); ?>
		  
		</div>
	</div>
</body>
</html>