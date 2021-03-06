
<div id="page-wrapper">
<div class="row">
	<div class="clearfix" style="height:20px;"></div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Navigations</h3>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-12">
					<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#createNew">Create New</button>
				</div>
				<div class="clearfix" style="height:10px;"></div>
				<div class="col-md-12">
					<div class="col-md-3">
						<ol class="serialization vertical">
			                <li data-id="0" data-name="Item 1">
			                  <i class="fa fa-arrows"></i> <a href="test.com">Item 1</a>
			                </li>
			                <li data-id="1" data-name="Item 2">
			                  <i class="fa fa-arrows"></i> Item 2
			                </li>
			                <li data-id="2" data-name="Item 3">
			                  <i class="fa fa-arrows"></i> Item 3
			                  <ol>
			                  </ol>
			                </li>
			                
			                <li data-id="3" data-name="Item 4">
			                  <i class="fa fa-arrows"></i> Item 4
			                  <ol>
			                  	<li data-id="3-0" data-name="Item 3.1" class=""><i class="fa fa-arrows"></i> Item 3.1
			                  		<ol>
				                  		<li data-id="3-0" data-name="Item 3.1" class=""><i class="fa fa-arrows"></i> Item 3.1</li>
					                  	<li data-id="3-1" data-name="Item 3.2" class=""><i class="fa fa-arrows"></i> Item 3.2</li>
						                <li data-id="3-2" data-name="Item 3.3" class=""><i class="fa fa-arrows"></i> Item 3.3</li>
						                <li data-id="3-3" data-name="Item 3.4" class=""><i class="fa fa-arrows"></i> Item 3.4</li>
						                <li data-id="3-4" data-name="Item 3.5" class=""><i class="fa fa-arrows"></i> Item 3.5</li>
						                <li data-id="3-5" data-name="Item 3.6" class=""><i class="fa fa-arrows"></i> Item 3.6</li>
					                </ol>
			                  	</li>
			                  	<li data-id="3-1" data-name="Item 3.2" class=""><i class="fa fa-arrows"></i> Item 3.2</li>
				                <li data-id="3-2" data-name="Item 3.3" class=""><i class="fa fa-arrows"></i> Item 3.3</li>
				                <li data-id="3-3" data-name="Item 3.4" class=""><i class="fa fa-arrows"></i> Item 3.4</li>
				                <li data-id="3-4" data-name="Item 3.5" class=""><i class="fa fa-arrows"></i> Item 3.5</li>
				                <li data-id="3-5" data-name="Item 3.6" class=""><i class="fa fa-arrows"></i> Item 3.6</li>
			                  </ol>
			                </li>
			                <li data-id="4" data-name="Item 5">
			                  <i class="fa fa-arrows"></i> Item 5
			                </li>
			                <li data-id="5" data-name="Item 6">
			                  <i class="fa fa-arrows"></i> Item 6
			                </li>
		              	</ol>

	              		
              		</div>
              		<div class="col-md-9">
              			<!-- <pre id="serialize_output2"></pre> -->
              			<pre id="serialize_output3"></pre>
              		</div>

				</div>
			</div>
		</div>
	</div>
</div>
</div>

<div class="modal fade" id="createNew" tabindex="-1" role="dialog" aria-labelledby="createNewLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="createNewLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        <form role="form">
		  <div class="form-group">
		    <label for="exampleInputEmail1">Email address</label>
		    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
		  </div>
		  <div class="form-group">
		    <label for="exampleInputPassword1">Password</label>
		    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
		  </div>
		  <div class="form-group">
		    <label for="exampleInputFile">File input</label>
		    <input type="file" id="exampleInputFile">
		    <p class="help-block">Example block-level help text here.</p>
		  </div>
		  <div class="checkbox">
		    <label>
		      <input type="checkbox"> Check me out
		    </label>
		  </div>
		  <button type="submit" class="btn btn-default">Submit</button>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
	var group = $("ol.serialization").sortable({
	  group: 'serialization',
	  pullPlaceholder: true,
	  //delay: 500,
	  onDrop: function (item, container, _super) {
	  	var clonedItem = $('<li/>').css({height: 0})
	    item.before(clonedItem)
	    clonedItem.animate({'height': item.height()})
	    
	    item.animate(clonedItem.position(), function  () {
	      clonedItem.detach()
	      _super(item)
	    })

	    var data = group.sortable("serialize").get();

	    var jsonString = JSON.stringify(data, null, ' ');

	    $('#serialize_output2').text(jsonString);
	    _super(item, container);

	    $.ajax({
	      url : '<?php echo base_url("navigations/sort"); ?>',
	      type : 'post',
	      data : 'string='+jsonString,
	      dataType : 'html',
	      success : function(json) {
	        $('#serialize_output3').html(json);
	      }
	    });  

	  },
	  // set item relative to cursor position
  onDragStart: function ($item, container, _super) {
    var offset = $item.offset(),
    pointer = container.rootGroup.pointer

    adjustment = {
      left: pointer.left - offset.left,
      top: pointer.top - offset.top
    }

    _super($item, container)
  },
  onDrag: function ($item, position) {
    $item.css({
      left: position.left - adjustment.left,
      top: position.top - adjustment.top
    })
  }
	});
</script>

<style type="text/css">

/* line 1, /Users/jonasvonandrian/jquery-sortable/source/css/jquery-sortable.css.sass */
body.dragging, body.dragging * {
  cursor: move !important; }

/* line 4, /Users/jonasvonandrian/jquery-sortable/source/css/jquery-sortable.css.sass */
.dragged {
  position: absolute;
  top: 0;
  opacity: 0.5;
  z-index: 2000; }

/* line 10, /Users/jonasvonandrian/jquery-sortable/source/css/jquery-sortable.css.sass */
ol.vertical {
  margin: 0 0 9px 0;
  min-height: 10px; }
  /* line 13, /Users/jonasvonandrian/jquery-sortable/source/css/jquery-sortable.css.sass */
  ol.vertical li {
    display: block;
    margin: 5px;
    padding: 5px;
    border: 1px solid #cccccc;
    color: #0088cc;
    background: #eeeeee; }
  /* line 20, /Users/jonasvonandrian/jquery-sortable/source/css/jquery-sortable.css.sass */
  ol.vertical li.placeholder {
    position: relative;
    margin: 0;
    padding: 0;
    border: none; }
    /* line 25, /Users/jonasvonandrian/jquery-sortable/source/css/jquery-sortable.css.sass */
    ol.vertical li.placeholder:before {
      position: absolute;
      content: "";
      width: 0;
      height: 0;
      margin-top: -5px;
      left: -5px;
      top: -4px;
      border: 5px solid transparent;
      border-left-color: red;
      border-right: none; }

/* line 32, /Users/jonasvonandrian/jquery-sortable/source/css/application.css.sass */
ol {
  list-style-type: none; }
  /* line 34, /Users/jonasvonandrian/jquery-sortable/source/css/application.css.sass */
  ol i.icon-move {
    cursor: pointer; }
  /* line 36, /Users/jonasvonandrian/jquery-sortable/source/css/application.css.sass */
  ol li.highlight {
    background: #333333;
    color: #999999; }
    /* line 39, /Users/jonasvonandrian/jquery-sortable/source/css/application.css.sass */
    ol li.highlight i.icon-move {
      background-image: url("../img/glyphicons-halflings-white.png"); }

/* line 42, /Users/jonasvonandrian/jquery-sortable/source/css/application.css.sass */
ol.nested_with_switch, ol.nested_with_switch ol {
  border: 1px solid #eeeeee; }
  /* line 44, /Users/jonasvonandrian/jquery-sortable/source/css/application.css.sass */
  ol.nested_with_switch.active, ol.nested_with_switch ol.active {
    border: 1px solid #333333; }

/* line 48, /Users/jonasvonandrian/jquery-sortable/source/css/application.css.sass */
ol.nested_with_switch li, ol.simple_with_animation li, ol.serialization li, ol.default li {
  cursor: pointer; }

/* line 51, /Users/jonasvonandrian/jquery-sortable/source/css/application.css.sass */
ol.simple_with_animation {
  border: 1px solid #999999; }

/* line 54, /Users/jonasvonandrian/jquery-sortable/source/css/application.css.sass */
.switch-container {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 80px; }

/* line 60, /Users/jonasvonandrian/jquery-sortable/source/css/application.css.sass */
.navbar-sort-container {
  height: 200px; }

/* line 64, /Users/jonasvonandrian/jquery-sortable/source/css/application.css.sass */
ol.nav li, ol.nav li a {
  cursor: pointer; }
/* line 66, /Users/jonasvonandrian/jquery-sortable/source/css/application.css.sass */
ol.nav .divider-vertical {
  cursor: default; }
/* line 69, /Users/jonasvonandrian/jquery-sortable/source/css/application.css.sass */
ol.nav li.dragged {
  background-color: #2c2c2c; }
/* line 71, /Users/jonasvonandrian/jquery-sortable/source/css/application.css.sass */
ol.nav li.placeholder {
  position: relative; }
  /* line 73, /Users/jonasvonandrian/jquery-sortable/source/css/application.css.sass */
  ol.nav li.placeholder:before {
    content: "";
    position: absolute;
    width: 0;
    height: 0;
    border: 5px solid transparent;
    border-top-color: red;
    top: -6px;
    margin-left: -5px;
    border-bottom: none; }
/* line 84, /Users/jonasvonandrian/jquery-sortable/source/css/application.css.sass */
ol.nav ol.dropdown-menu li.placeholder:before {
  border: 5px solid transparent;
  border-left-color: red;
  margin-top: -5px;
  margin-left: none;
  top: 0;
  left: 10px;
  border-right: none; }

/* line 94, /Users/jonasvonandrian/jquery-sortable/source/css/application.css.sass */
.sorted_table tr {
  cursor: pointer; }
/* line 96, /Users/jonasvonandrian/jquery-sortable/source/css/application.css.sass */
.sorted_table tr.placeholder {
  display: block;
  background: red;
  position: relative;
  margin: 0;
  padding: 0;
  border: none; }
  /* line 103, /Users/jonasvonandrian/jquery-sortable/source/css/application.css.sass */
  .sorted_table tr.placeholder:before {
    content: "";
    position: absolute;
    width: 0;
    height: 0;
    border: 5px solid transparent;
    border-left-color: red;
    margin-top: -5px;
    left: -5px;
    border-right: none; }

/* line 114, /Users/jonasvonandrian/jquery-sortable/source/css/application.css.sass */
.sorted_head th {
  cursor: pointer; }
/* line 116, /Users/jonasvonandrian/jquery-sortable/source/css/application.css.sass */
.sorted_head th.placeholder {
  display: block;
  background: red;
  position: relative;
  width: 0;
  height: 0;
  margin: 0;
  padding: 0; }
  /* line 124, /Users/jonasvonandrian/jquery-sortable/source/css/application.css.sass */
  .sorted_head th.placeholder:before {
    content: "";
    position: absolute;
    width: 0;
    height: 0;
    border: 5px solid transparent;
    border-top-color: red;
    top: -6px;
    margin-left: -5px;
    border-bottom: none; }
</style>