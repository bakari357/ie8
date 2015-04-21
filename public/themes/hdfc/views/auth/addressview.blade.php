
<div class="modal" id="my-modal">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
		
		<h2 style="font-weight:bold;color:#666666">Address Form</h2>
	</div>
	<div class="modal-body">
		<div class="alert allert-error hide" id="form-error">
			<a class="close" data-dismiss="alert">×</a>
		</div>
		{{Form::open(array("id"=>"addressview","role"=>"form"))}}
		<input type="hidden" name="id" value="<?php if(isset($id)){ echo $id;}  ?>" id="id" class="txt_signup2" autocomplete="off"  />
		<div class="row-fluid">
		
		
		
			<div class="span12">
				<label>Company</label>
				<input type="text" name="company" value="<?php if(isset($company)){ echo $company;}  ?>" id="company" class="txt_signup2" autocomplete="off"  />
			</div>
		</div>
		<div class="row-fluid">
			<div class="span6">
				<label>* Firstname</label>
				<input type="text" name="firstname" value="<?php if(isset($firstname)){ echo $firstname;}?>" id="firstname" class="txt_signup"  autocomplete="off"  />
				<font color='red' style='margin-top: 48px;margin-left: -201px;position: absolute;'>{{ $errors->first('firstname') }} </font>
			</div>
			<div class="span6">
				<label>Lastname</label>
				<input type="text" name="lastname" value="<?php if(isset($lastname)){ echo $lastname;}?>" id="lastname" class="txt_signup"  autocomplete="off"  />
				<font color='red' style='margin-top: 48px;margin-left: -201px;position: absolute;'>{{ $errors->first('lastname') }} </font>
			</div>
			
		</div>
		<div class="row-fluid">
			<div class="span6">
				<label>* Email</label>
				<input type="text" name="email" value="<?php if(isset($email)){ echo $email;}?>" id="email" class="txt_signup"  autocomplete="off"  />
				<font color='red' style='margin-top: 48px;margin-left: -201px;position: absolute;'>{{ $errors->first('email') }} </font>
			</div>
			<div class="span6">
				<label>* Phone</label>
				<input type="text" name="phone" value="<?php if(isset($phone)){ echo $phone;}?>" id="phone" class="txt_signup"  autocomplete="off"  />
				<font color='red' style='margin-top: 48px;margin-left: -201px;position: absolute;'>{{ $errors->first('phone') }} </font>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span12">
				<label>* Address</label>
				<input type="text" name="address1" value="<?php if(isset($address1)){ echo $address1;}?>" id="address1" class="txt_signup"  autocomplete="off"  />
				<font color='red' style='margin-top: 48px;margin-left: -201px;position: absolute;'>{{ $errors->first('address1') }} </font>
				<input type="text" name="address2" value="<?php if(isset($address2)){ echo $address2;}?>" id="address2" class="txt_signup"  autocomplete="off"  />
			</div>
		</div>
		<div class="row-fluid">
			<div class="span12">
				<label>* Country</label>
			<?php echo Form::select('country_id',$countries_menu,null,array( "id"=>"country_id","class"=>"seloption","style"=>"opacity: 10; position: relative; z-index: 100;")); ?>	
			</div>
		</div>
		<div class="row-fluid">
			<div class="span4">
				<label>* City</label>
			<input type="text" name="city" value="<?php if(isset($city)){ echo $city;}?>" id="city" class="txt_signup"  autocomplete="off"  />
			<font color='red' style='margin-top: 48px;margin-left: -201px;position: absolute;'>{{ $errors->first('city') }} </font>	
			</div>
			<div class="span6">
				<label>* State</label>
				<?php $zone_id = isset($zone_id) ? $zone_id : '';?>
			<?php echo Form::select('zone_id',$zones_menu,$zone_id,array( "id"=>"zone_id","class"=>"seloption","style"=>"opacity: 10; position: relative; z-index: 100;")); ?>	
			</div>
			<div class="span2">
				<label>* ZIP</label>
			<input type="text" name="zip" value="<?php if(isset($zip)){ echo $zip;}?>" id="zip" class="txt_signup"  autocomplete="off"  />	
			<font color='red' style='margin-top: 48px;margin-left: -201px;position: absolute;'>{{ $errors->first('zip') }} </font>
			</div>
		</div>
	</div>
	<div>
	<div class="modal-footer">

		<input type="button" value="submit" onclick="save_address();" />
		{{Form::close()}}
	</div>
</div>
<script>
function save_address()
{        
	var id = $("#id").val();
              $.ajax({
                      type: "POST",
                    
                     url: "address_form/"+ id +" ",
                    
                      data: ({
                 company: $('#company').val(),
	firstname: $('#firstname').val(),
	lastname: $('#lastname').val(),
	email: $('#email').val(),
	phone: $('#phone').val(),
	address1: $('#address1').val(),
	address2: $('#address2').val(),
	city: $('#city').val(),
	country_id: $('#country_id').val(),
	zone_id: $('#zone_id').val(),
	zip: $('#zip').val()
              }),             
                  success:     function(data){
			if(data == 1)
			{  
				window.location = "{{ url::to('my_addressbook')}}";
			}
			else
			{  
				$('#form-error').html(data).show();
			}
                  }
	
		});
}
</script>

