<div id="main-content" class="col-12 col-sm-8 col-lg-8 panel panel-default">
  	<div class="panel">
		  <div class="panel-heading">
		    Them Truyen
	  </div>
	  	<form class="form-horizontal" name="story" action="/truyen/themtruyen" method="post">
		  <div class="form-group">
		    <label for="inputTitle" class="col-lg-2 control-label">story_name</label>
		    <div class="col-lg-10">
		      <input type="text" class="form-control" id="inputTitle" placeholder="story_name" name="name">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="editor" class="col-lg-2 control-label">story_description</label>
		    <div class="col-lg-10">
		     <textarea class="form-control" id="editor" rows="3" name="description"></textarea>
		    </div>
		  </div>
		  <div class="form-group">
		    <div class="col-lg-offset-2 col-lg-10">
		      <button type="submit" class="btn btn-default">Submit</button>
		    </div>
		  </div>
		</form>
  	</div>

</div>