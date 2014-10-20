<nav class="navbar navbar-default" role="navigation" id="categoies">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="<?php echo $home; ?>">Home</a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav">
    <?php foreach ($categoryData as $cat){?>
      <li <?php if(isset($currentCategory) && strcmp($currentCategory->permalink,$cat->permalink) == 0){ ?>
    	class="active"  
	<?php  }?> ><a href="<?php echo $home.'/category/'.$cat->permalink;?>"><?php echo $cat->categoryname;?></a></li>
      <?php }?>
    </ul>
  </div><!-- /.navbar-collapse -->
</nav>