@extends('cpanel::layouts')

@section('header')
<h1>Tier</h1>
@stop

@section('breadcrumb')
@parent
<li>
    <a href="{{route('cpanel.tiers.index')}}">
        <i class="fa fa-user"></i>
        Tiers
    </a>
</li>
<li class="active">Create</li>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <?php
            $option = array(
                'route' => 'cpanel.tiers.store',
                'class' => 'form-horizontal'
            );
            ?>
            {{ Form::open($option) }}

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Create a new tiers</h3>
                </div>
                <div class="panel-body">
                    <div class="tabbable">

                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active">
                                <a href="#credentials" data-toggle="tab">Tiers Credentials</a>
                            </li>
                            

                        <li>
                                <a href="#account" data-toggle="tab">Extended Data</a>
                            </li>
                        </ul>

                        <div class="tab-content">

                            <div class="tab-pane active" id="credentials">
                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Last Name">Tier Name</label>
                                    <div class="col-md-4">
                                        {{ Form::text('tier_name',null,array('class'=>'form-control','placeholder'=>'Tier name')) }}
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="Tier Name">Tier Level</label>
                                    <div class="col-md-4">
                                        {{ Form::text('tier_level',null,array('class'=>'form-control','placeholder'=>'Tier Level')) }}
                                    </div>
                                </div>


                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="pp Currency">Points Pool Currency to 1 Rupee ratio for tier</label>
                                    <div class="col-md-4">
                                        {{ Form::text('pp_currency',null,array('class'=>'form-control','placeholder'=>'points pool currency to 1 Rupee ratio for tier')) }}
                                    </div>
                                </div>

                           
                         <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>





                 
                     

                              <div class="tab-pane" id="account">
                                  
                                     <div class="form-group">
                                    <label class="col-sm-2 control-label" for="short_description">Maker Comments</label>
                                    <div class="col-md-7">
                                        {{ Form::textarea('maker_comment',null,array('class'=>'form-control ')) }}
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="short_description">Checker Comments</label>
                                    <div class="col-md-7">
                                        {{ Form::textarea('checker_comment',null,array('class'=>'form-control ')) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="short_description">Other Details</label>
                                    <div class="col-md-7">
                                        {{ Form::textarea('Details',null,array('class'=>'form-control ')) }}
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
