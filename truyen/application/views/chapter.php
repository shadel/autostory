<div id="main-content" class="col-12 col-sm-8 col-lg-8 panel panel-default">
  <div class="panel-heading">
  	<ul class="breadcrumb">
	  <li><a href="/truyen/<?php echo $story->permalink;?>"><?php echo $story->storyname;?></a></li>
	  <li class="active"> <?php echo $chapter->no;?> - <a href="/truyen/<?php echo $story->permalink.'/'.$chapter->permalink;?>"><?php echo $chapter->name;?></a></li>
	</ul>
  </div>
  	<ul class="pager">
  	<?php if(isset($chapterPrev)){?>
	  <li class="previous"><a href="/truyen/<?php echo $story->permalink.'/'.$chapterPrev->permalink;?>">&larr; Older</a></li>
	  <?php }?>
	  <?php if(isset($chapterNext)){?>
	  <li class="next"><a href="/truyen/<?php echo $story->permalink.'/'.$chapterNext->permalink;?>">Newer &rarr;</a></li>
	  <?php }?>
	</ul>
  	<div class="">
		 <?php echo $chapter->content;?>
  	</div>
  	<ul class="pager">
  	<?php if(isset($chapterPrev)){?>
	  <li class="previous"><a href="/truyen/<?php echo $story->permalink.'/'.$chapterPrev->permalink;?>">&larr; Older</a></li>
	  <?php }?>
	  <?php if(isset($chapterNext)){?>
	  <li class="next"><a href="/truyen/<?php echo $story->permalink.'/'.$chapterNext->permalink;?>">Newer &rarr;</a></li>
	  <?php }?>
	</ul>
</div>