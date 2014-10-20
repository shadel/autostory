<div class=" panel panel-default">	 
<div class="panel-heading">Newest</div>
  	<ul class="list-group  stories-group">
  		<?php if($chapters){?>
  		<?php foreach ($chapters as $chapter){ ?>
		<li class="list-group-item media">
		    <div class="media-body">
		     <span class="story-number"> <?php echo $chapter->no;?> </span> <a href="/truyen/<?php echo $story->permalink.'/'.$chapter->permalink;?>"><?php echo $chapter->name;?></a>
		    </div>
		</li>
		<?php }} ?>
	  	</ul>
</div>