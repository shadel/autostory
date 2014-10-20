
  	<ul class="list-group stories-group">
  		<?php foreach ($data as $key => $story){ ?>
		<li class="list-group-item media">
		     <div class="media-body">
		    	<span class="story-number"><?php echo $key + 50*($page - 1) + 1;?></span>
		      	  <small><a class="category-name" href="/category/<?php echo $story->capermalink;?>"><?php echo $story->categoryname;?></a> |</small> 
		      	<a href="/truyen/<?php echo $story->permalink;?>"><?php echo $story->storyname;?></a>
		     	<span class="badge pull-right number-of-chapter"><?php echo $story->count;?></span>
		    </div>
		</li>
		<?php } ?>
	  	</ul>
