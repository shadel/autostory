

<div id="main-content-story" class="col-12 col-sm-8 col-lg-8">
<ul class="nav nav-tabs" id="story-tab">
  <li class="active"><a href="#story-info" data-toggle="tab">Thông tin truyện</a></li>
  <li><a href="#chapter-list" data-toggle="tab">Danh sách chương</a></li>
</ul>

<div class="tab-content">
  <div class="tab-pane active" id="story-info">
  	<?php $this->load->view('story_info', array(
  			'story_img' => $story_img,
  			'story_name' => $story_name,
  			'author_name' => $author_name,
  			'category_name' => $category_name,
  			'category_link' => $category_link,
  			'status' => $status,
  			'description' => $description
  			)); ?>
  	<?php $this->load->view('chapter_newest_list', array(
  			'chapter_news' => $chapter_news
  			)); ?>
  </div>
  <div class="tab-pane" id="chapter-list"><?php $this->load->view('chapter_list', array(
  		'chapter_list' => $chapter_list,
  		'paging' => $paging,
  		'page' => $page
  		)); ?></div>
</div>
</div>
<script>
  $(function () {
	  <?php if(!$open_cl){?>
    $('#story-tab a:first').tab('show');
    <?php } else {?>
    $('#story-tab a:last').tab('show');
    <?php }?>
	   });
</script>