<div id="main-content"
	class="col-12 col-sm-8 col-lg-8 panel panel-default">
	<div class="panel-heading">Danh sach</div>
   <?php $this->load->view('story_list', array('story_list' => $story_list, 'page' => $page)); ?>
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

