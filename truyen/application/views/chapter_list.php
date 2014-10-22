<div class=" panel panel-default">	 
 <div class="panel-body">
 <ul class="pagination">
	  	<?php foreach ($paging as $p){ ?>
  	<li class="<?php echo $p['class']; ?>"><a
			href="<?php 
			if (isset($p['link'])) {
				echo $p['link'];
			} else {echo '#';}
			?>"><?php if ($p['class'] == 'next') {echo '&raquo;';} else if ($p['class'] == 'previous') {echo '&laquo;';} else {echo $p['name'];}?></a></li>
  	<?php }?>
	</ul>
  	<ul class="list-group  stories-group">
  		<?php if($chapter_list){?>
  		<?php foreach ($chapter_list as $key => $chapter){ ?>
		<li class="list-group-item media">
		    <div class="media-body">
		     <span class="story-number"> <?php echo $key + 50*($page - 1) + 1;?> </span> <a href="<?php echo $chapter['chapter_link'];?>"><?php echo $chapter['chapter_name'];?></a>
		    </div>
		</li>
		<?php }} ?>
	  	</ul>
  	<ul class="pagination">
	  	<?php foreach ($paging as $p){ ?>
  	<li class="<?php echo $p['class']; ?>"><a
			href="<?php 
			if (isset($p['link'])) {
				echo $p['link'];
			} else {echo '#';}
			?>"><?php if ($p['class'] == 'next') {echo '&raquo;';} else if ($p['class'] == 'previous') {echo '&laquo;';} else {echo $p['name'];}?></a></li>
  	<?php }?>
	</ul>
</div>
</div>