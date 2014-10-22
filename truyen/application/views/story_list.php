
<ul class="list-group stories-group">
  	<?php foreach ($story_list as $key => $story){ ?>
	<li class="list-group-item media">
		<div class="media-body">
			<span class="story-number"><?php echo $key + 50*($page - 1) + 1;?></span>
			<small>
			<?php if (isset($story['category_link'])) {?>
			<a class="category-name"
				href="<?php echo $story['category_link'];?>"><?php echo $story['category_name'];?></a>
				| <?php }?></small> <a href="<?php echo $story['story_link'];?>"><?php echo $story['story_name'];?></a>
			<span class="badge pull-right number-of-chapter"><?php echo $story['status'];?></span>
			<span class="badge pull-right">
				<a class="last-chapter"
				href="<?php echo $story['chapter_link'];?>"><?php echo $story['chapter_name'];?></a>
			</span>
		</div>
	</li>
	<?php } ?>
</ul>
