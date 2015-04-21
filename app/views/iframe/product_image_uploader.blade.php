
<script type="text/javascript">
<?php if($file_name):?>
	parent.add_product_image('<?php echo $file_name;?>');
<?php endif;?>

</script>

<?php if (!empty($error)): ?>
	<div class="alert alert-error">
		<a class="close" data-dismiss="alert">×</a>
		<?php echo $error; ?>
	</div>
<?php endif; 
 $option = array(
                'route' => 'cpanel.widget.upload_images',
                'method' => 'put',
                'class' => 'form-inline',
                'files' =>true
            );
            ?>
            
<div class="row-fluid">
	<div class="span12">
			{{ Form::open($option) }}
			<input type="file", name="userfile", id='userfile', class = 'input-file'/>
			<input class="btn" type="submit" value="<?php echo 'upload';?>" />
		{{ Form::close() }}
	</div>
</div>

