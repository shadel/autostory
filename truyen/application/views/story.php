

<div id="main-content-story" class="col-12 col-sm-8 col-lg-8">
<ul class="nav nav-tabs" id="story-tab">
  <li class="active"><a href="#story-info">Info</a></li>
  <li><a href="#chapter-list">Chapter list</a></li>
</ul>

<div class="tab-content">
  <div class="tab-pane active" id="story-info">
  	<?php $this->load->view('story_info', array('story' => $story)); ?>
  	<?php $this->load->view('chapter_newest_list', array('story' => $story, 'chapters' => $newest_chapters)); ?>
  </div>
  <div class="tab-pane" id="chapter-list"><?php $this->load->view('chapter_list',  array(
  		'chapters' => $chapters,
  		'page' => $page,
  		'totalPage' => $totalPage,
  		'story' =>$story
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
	  $('#story-tab a').click(function (e) {
		  e.preventDefault();
		  $(this).tab('show');
		});
  });
</script>