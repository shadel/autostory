<div class=" panel panel-default">	 
 <div class="panel-body">
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
  	<ul class="pagination">
	  	<?php if($page <= 1){?>
	  <li class="disabled"><a href="#">&laquo;</a></li>
	  <?php }else{?>
	  <li ><a href="/">&laquo;</a></li>
	  <?php }?>
	  <?php for($i = 1; $i<= $totalPage; $i++){?>
	  <?php if($i<=1 || ($i >= $totalPage - 1) || ($page - $i <=1 && $page>=$i)  || ($page - $i >= -1 && $page<=$i)){?>
	  <li <?php if($i==$page){?>class="active"<?php }?>><a href="/truyen/<?php echo $story->permalink;?>/page/<?php  echo $i;?>"><?php echo $i;?></a></li>
	  <?php }else {?>
	  	<?php if($i==2 || $i == $totalPage - 2){?>
	  	<li class="disabled"><a href="#">...</a></li>
	  	<?php }?>
	  <?php }?>
	  <?php }?>
	  <?php if($page >= $totalPage){?>
	  <li class="disabled"><a href="#">&raquo;</a></li>
	  <?php }else{?>
	  <li ><a href="/truyen/<?php echo $story->permalink;?>/page/<?php echo $totalPage; ?>">&raquo;</a></li>
	  <?php }?>
	</ul>
</div>
</div>