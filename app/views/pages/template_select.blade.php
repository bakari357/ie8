@extends('cpanel::layouts')

@section('header')
<h1>Pages</h1>
@stop

@section('breadcrumb')
@parent
<li>
    <a href="{{route('cpanel.pages.index')}}">
        <i class="fa fa-user"></i>
        Pages
    </a>
</li>
<li class="active">Create</li>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <?php


            $option = array(
                'route' => 'cpanel.pages.changeactive',
                'class' => 'form-horizontal'
            );
            ?>
            {{ Form::open($option) }}

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Create a new Template</h3>
                </div>
                <div class="panel-body">
                    <div class="tabbable">


                        <div class="tab-content">

                            <div class="tab-pane active" id="credentials">
                                <legend class="margin-top-10">Template Informations</legend>
 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="title">City</label>
                                    <div class="col-md-4">
                                          <select id="groups" name="city" class="select2 form-control">
                      <?php if(isset($template)) { 
                        foreach ($template as $city) { ?>
                                            
                                            <option  value="<?php echo $city->id; ?>"><?php echo $city->templ_name; ?></option>
<?php } } ?>
                                        </select>
                                    </div>
                                </div>
                                

                               

                                  <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Submit</button>
					 
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
@stop
