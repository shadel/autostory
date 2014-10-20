<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		<?php echo 'Truyen.wpat.net';?>
		<?php if(isset($currentCategory)){
			echo '|'.$currentCategory->categoryname;
		}?>
		<?php if(isset($contentData['story'])){
			echo '|'.$contentData['story']->storyname;
		}?>
		<?php if(isset($contentData['chapter'])){
			echo '|'.$contentData['chapter']->name;
		}?>
	</title>

	 <link href="/libs/css/bootstrap.min.css" rel="stylesheet" media="screen" >
	 <link href="/libs/css/custom.css" rel="stylesheet" media="screen" >
	 <script type="text/javascript" src="/libs/js/jquery.min.js" ></script>
	 <script type="text/javascript" src="/libs/js/bootstrap.min.js" ></script>
	 <script type="text/javascript" src="/libs/js/tab.js" ></script>
</head>
<body>
	<div class="container">
		<div class="row"  id="header">
		 	<div class="page-header">
		  		<a href="<?php echo $home; ?>"><h1>Truyen<small>.wpat.net</small></h1></a>
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