<div class=" panel panel-default">
  <div class="panel-body">
	  <div class="media">
		 <a class="pull-left" href="/truyen/<?php echo $story->permalink;?>">
		    <img class="media-object" src="<?php if(isset($story->image) && (strcmp($story->image,$exceptImg) != 0))
		    {echo $story->image;}else{echo $home;?>/img/download.png<?php }?>" alt="<?php echo $story->storyname;?>">
		  </a>
		  <div class="media-body">
		    <h4 class="media-heading"><?php echo $story->storyname;?></h4>
		    <small><?php echo $story->description;?></small>
		  </div>
		</div>
	</div>
</div>