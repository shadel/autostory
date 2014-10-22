<div id="main-content"
	class="col-12 col-sm-8 col-lg-8 panel panel-default">
	<div class="panel-heading">
		<ul class="breadcrumb">
			<li><a href="<?php echo $story_link;?>"><?php echo $story_name;?></a></li>
			<li class="active"> <?php echo $chapter_name;?></li>
		</ul>
	</div>
	<ul class="pager">
		<li class="previous"><a href="#">&larr; Older</a></li>
		<li class="next"><a href="#">Newer &rarr;</a></li>
	</ul>
	<div class="" id="ar-content-html">
		 <?php echo $body;?>
  	</div>
	<ul class="pager">
		<li class="previous"><a href="#">&larr; Older</a></li>
		<li class="next"><a href="#">Newer &rarr;</a></li>
	</ul>
</div>

<?php

foreach ( $scripts as $script ) {
	echo $script;
}
?>
<script type="text/javascript">


$(document).ready(function() {
  $('.previous').click(function() {
page_pre();
    return false;
    });
  $('.next').click(function() {
    page_next();
        return false;
        });
});

	
$(document).keydown(function(e){
	
	var code = (e.keyCode ? e.keyCode : e.which);
	 if(code == 37) { //left
	   page_pre();
	 }
	 
	 if(code == 39) { //right
	   page_next();
	 }
});

function adjustTextSize(elId, Step) {
var el = document.getElementById(elId);
var num = parseFloat(el.style.fontSize);
if (isNaN(num)) num = 2;
num += Step;
if (num > 5) num = 5;
if (num < 1.5) num = 1.5;
el.style.fontSize = (num + "em");
	
	$.cookie('font_size', el.style.fontSize, { expires: 9999, path: '/', domain: 'tubu.test' });
}

function setTextSize(elId, size) {
var el = document.getElementById(elId);
el.style.fontSize = size;

}

if ($.cookie("font_size") != '' )
{
	setTextSize('ar-content-html', $.cookie("font_size"));
}

</script>