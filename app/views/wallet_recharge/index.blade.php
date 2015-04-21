@extends('cpanel::layouts')

@section('header')
    <h1>Pages</h1>
@stop

@section('breadcrumb')
    @parent
    <li class="active"><i class="fa fa-user"></i> Pages</li>
@stop

@section('content')

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
               
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>

                            <th>Enterprise Name</th>
                            <th class="hidden-xs">Recharge Amount</th>
                             <th class="hidden-xs">Comment</th>
                            <th class="hidden-xs">Recharge Request date</th>
                            <th class="hidden-xs">Created On</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($rechargelist as $banners)
                        <tr>
                            <td>{{ HTML::linkRoute('cpanel.walletsrecharge.show_rechargelist',$banners->enterprise_name, array($banners->id)) }}</td>
				<td class="hidden-xs">{{{ $banners->recharge_amount }}}</td>
				<td class="hidden-xs">{{{ $banners->comment }}}th</td>
                            <td class="hidden-xs">{{{ $banners->recharge_request_date}}}</td>
                            <td class="hidden-xs">{{{ $banners->created_on }}}</td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
                                        Action
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('cpanel.walletsrecharge.show_rechargelist', array($banners->id)) }}">
                                                <i class="fa fa-info-circle"></i>&nbsp;View Page
                                            </a>
                                        </li>
                                        
                                       
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@stop
