<div class=" panel panel-default">	 
<div class="panel-heading">Chương mới nhất</div>
  	<ul class="list-group  stories-group">
  		<?php if($chapter_news){?>
  		<?php foreach ($chapter_news as $key => $chapter){ ?>
		<li class="list-group-item media">
		    <div class="media-body">
		     <span class="story-number"> <?php echo $key + 1;?> </span> <a href="<?php echo $chapter['chapter_link'];?>"><?php echo $chapter['chapter_name'];?></a>
		    </div>
		</li>
		<?php }} ?>
	  	</ul>
</div>