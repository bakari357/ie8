@extends('cpanel::layouts')

@section('header')
<h1>Pages</h1>
@stop

@section('breadcrumb')
@parent
<li>
    <a href="{{route('cpanel.pages.index')}}">
        <i class="fa fa-page"></i>
        Pages
    </a>
</li>
<li class="active">Edit</li>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <?php
        $option = array(
            'route' => array('cpanel.widget.update',$page->id),
            'method' => 'put',
            'class' => 'form-horizontal'
        );
        ?>
        {{ Form::model($page,$option) }}
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Edit Page &quot;{{ $page->title }}&quot;</h3>
            </div>
            <div class="panel-body">
                <div class="tabbable">

                  
                    <div class="tab-content">
                        <div class="tab-pane active" id="credentials">
                            <div class="margin-top-20">

                               <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Title</label>
                                    <div class="col-md-4">
                                        {{ Form::text('name',null,array('class'=>'form-control','placeholder'=>'Name')) }}
                                    </div>
                                </div>


<div class="form-group">
                                    <label class="col-sm-2 control-label" for="description">Description</label>
                                    <div class="col-md-10">
                                        {{ Form::textarea('description',null,array('class'=>'form-control ckeditor','placeholder'=>'Short Description')) }}
                                    </div>
                                </div>
                                    <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Template</label>
                                    <div class="col-md-4">
                                         <select id="templ" name="template" onchange="region();" class="select2 form-control">
                                       <option selected="selected" value="">Select template</option>
              <?php if(isset($template) && !empty($template)) { 
                   foreach ($template as $templates) { ?>
                                            
                                            <option  value="<?php echo $templates->id; ?>"><?php echo $templates->templ_name; ?></option>
<?php } }?>
                                        </select>
                                    </div>
                                </div>
                                 <div id="region">
       </div>
                       <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">Position</label>
                                    <div class="col-md-4">
                                         <select id="source" name="position"  class="select2 form-control">
                                       <option selected="selected" value="">Select template</option>
                                      <option  value="1">1</option>	
					<option  value="2">2</option>
					<option  value="3">3</option>
					<option  value="4">4</option>
             
                                        </select>
                                    </div>
                                </div>



<div class="tab-pane" id="images">	
                     
                    <?php if(isset($_POST['images'])){ print_r($_POST['images']); } else { echo 'no images'; }?>
 
  <div class="row" >
		<div class="span3">
		<iframe id="iframe_uploader" src="{{ route('cpanel.widget.image_upload') }}" class="span8" style="height:75px; border:0px;margin-left:0px !important;"></iframe>
				</div>
				<div class="row" style="margin-left:0px;">
					<div class="span8" style="width:641px;">

						<div id="gc_photos">
						
						<?php
						foreach($images as $photo_id=>$photo_obj)
						{
							if(!empty($photo_obj))
							{
								$photo = (array)$photo_obj;
						add_image($photo_id, $photo['filename'], $photo['alt'], $photo['caption'], $photo['url'], isset($photo['primary']));
							}

						}
						?>
						</div>
					</div>
			</div>
		</div>
                                               <div class="form-group">
                                    <label class="col-sm-2 control-label" for="active">Active</label>
                                    <div class="col-md-4">
                                        {{ Form::checkbox('active', '1') }}
                                     </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a class="btn btn-primary" href="{{route('cpanel.pages.index')}}">Cancel</a>
                                    </div>
                                </div>
                            </div>

                        </div>

                       
                    </div>

                </div>
            </div>
        </div>

        {{Form::close()}}

    </div>
</div>
<script>

function add_product_image(data)
{	p	= data.split('.');
	var photo = '<?php add_image("'+p[0]+'", "'+p[0]+'.'+p[1]+'", '', '', '', '', "uploads/images/thumbnails");?>';
	$('#gc_photos').append(photo);
	$('#gc_photos').sortable('destroy');
	photos_sortable();
}

function remove_image(img)
{
	if(confirm('confirm_remove_image'))
	{
		var id	= img.attr('rel')
		$('#gc_photo_'+id).remove();
	}
}

function photos_sortable()
{
	$('#gc_photos').sortable({
		handle : '.gc_thumbnail',
		items: '.gc_photo',
		axis: 'y',
		scroll: true
	});
}
function region()
{
 var city=$("select#templ option:selected").val();
	$.ajax({
                      type: "POST",
                      url: "<?=URL::to('region')?>",
                      data: {
               "city": city
              },             
                        success: function(data1) {
                          $("#region").html(data1);
                      }
                  });
}
</script> 
<?php
function add_image($photo_id, $filename, $alt, $caption, $url, $primary=false)
{
	ob_start();
	?>
	<div class="row gc_photo" id="gc_photo_<?php echo $photo_id;?>" style="background-color:#fff; border-bottom:1px solid #ddd; padding-bottom:20px; margin-bottom:20px;margin-left:0px;">
		<div class="span2">
			<input type="hidden" name="images[][filename]" value="<?php echo $filename;?>"/>
			<?php echo HTML::image('/uploads/images/widget/'.$filename,'', array('class' => 'gc_thumbnail','style'=>'padding:5px; border:1px solid #ddd')); ?>
		</div>
		</div>

	<?php
	$stuff = ob_get_contents();

	ob_end_clean();

	echo replace_newline($stuff);
}

function replace_newline($string) {
  return trim((string)str_replace(array("\r", "\r\n", "\n", "\t"), ' ', $string));
}
?>
@stop
