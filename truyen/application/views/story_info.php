<div class=" panel panel-default">
  <div class="panel-body">
	  <div class="media">
		 <a class="pull-left" href="#">
		    <img class="media-object" src="<?php if(isset($story_img) && (strcmp($story_img, $exceptImg) != 0))
		    {echo $story_img;}else{echo $home;?>/img/download.png<?php }?>" alt="<?php echo $story_name;?>">
		  </a>
		  <div class="media-body">
		    <h4 class="media-heading"><?php echo $story_name;?></h4>
		    <small><?php echo $description;?></small>
		  </div>
		</div>
	</div>
</div>