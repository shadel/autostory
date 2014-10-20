<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Welcome to CodeIgniter</title>

	 <link href="/libs/css/bootstrap.min.css" rel="stylesheet" media="screen" >
	 <link href="/libs/css/custom.css" rel="stylesheet" media="screen" >
	 <script type="text/javascript" src="/libs/js/jquery.min.js" ></script>
	 <script type="text/javascript" src="/libs/js/bootstrap.min.js" ></script>
	 <script type="text/javascript" src="/libs/js/autocraw.js" ></script>
	 <script type="text/javascript" src="/libs/js/async.js" ></script>
</head>
<body>
	<div class="container">
		<div class="row"  id="header">
		 	<div class="page-header">
		  		<h1>Truyen<small>.wpat.net</small></h1>
			</div>
		</div>
		<div class="row" >
			<div id="main-content" class="col-12 col-sm-8 col-lg-8">
				<div class="panel">
					<div class="panel-heading">
						    List crawl
					  </div>
					  <button type="button" class="btn btn-default" id="refresh">Refresh</button>
					  <button type="button" class="btn btn-default" id="create_story">Create Story</button>
					  <button type="button" class="btn btn-default" id="create_chapter">Create Chapter</button>
				  	<ul class="list-group">
				  		<?php if($stories){?>
				  		<?php foreach ($stories as $story){ ?>
						<li class="list-group-item story-item" url-data="<?php echo $story->url;?>" crawled="<?php echo $story->crawled;?>" story-id="<?php echo $story->id;?>" >
						    <div class="media-body">
						      <?php echo $story->category;?> - <?php echo $story->story;?>
						    </div>
						</li>
						<?php }} ?>
					  	</ul>
				  	</div>
		    </div>
		    <div id="sidebar" class="col-6 col-sm-4 col-lg-4">.col-6 .col-lg-4</div>
		</div>
	</div>
	<script type="text/javascript">
	(function(){
		$('#refresh').bind('click', function(){
			var target = 'http://truyen2.hixx.info/truyen.html';
			getAllStory(target);
		});

		crawlStory = function(value){
			var url = $(value).attr('url-data');
			if($(value).attr('crawled').length > 1){
				url = $(value).attr('crawled');
			}
			createStory(url, $(value).attr('url-data'));
		};
		$('#create_story').bind('click', function(){
			
			crawlStory($('.story-item')[0]);
		});

		$(window).bind('crawled', function(e, url){
			console.log(arguments);
			var value = $('li[url-data="' + url +'"]').next();
			crawlStory(value);
		});
	})();
	</script>
</body>
</html>