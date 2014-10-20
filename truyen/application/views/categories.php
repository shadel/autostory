<div id="main-content" class="col-12 col-sm-8 col-lg-8 panel panel-default">
	  <div class="panel-heading">
	    Danh sach
	  </div>
	  <?php $this->load->view('story_list', array('data' => $data, 'page' => $page)); ?>
  	
  	<ul class="pagination">
  		<?php if($page <= 1){?>
	  <li class="disabled"><a href="#">&laquo;</a></li>
	  <?php }else{?>
	  <li ><a href="/">&laquo;</a></li>
	  <?php }?>
	  <?php for($i = 1; $i<= $totalPage; $i++){?>
	  <li <?php if($i==$page){?>class="active"<?php }?>><a href="/category/<?php echo $currentCategory->permalink;?>/page/<?php  echo $i;?>"><?php echo $i;?></a></li>
	  <?php }?>
	  <?php if($page >= $totalPage){?>
	  <li class="disabled"><a href="#">&raquo;</a></li>
	  <?php }else{?>
	  <li ><a href="/category/<?php echo $currentCategory->permalink;?>/page/<?php echo $totalPage; ?>">&raquo;</a></li>
	  <?php }?>
	</ul>
</div>