@extends('cpanel::layouts')

@section('header')
    <h1>Users</h1>
@stop

@section('breadcrumb')
@parent

<li>
    <a href="{{route('cpanel.pages.index')}}">
        <i class="fa fa-page"></i>
        Pages
    </a>
</li>
<li class="active">Show</li>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
  
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    {{ $page->title }} Page
                </h3>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">
                <div class="tabbable">
                <span style="float:right;margin-bottom:10px;"><a class="btn btn-primary" href="{{route('cpanel.pages.index')}}">Cancel</a></span>

                    <div class="tab-content">

                        <div class="tab-pane active" id="info">
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                    <td><strong>Title</strong></td>
                                    <td>{{ $page->title }}</td>
                                </tr>
                                <tr>
                                    <td><strong>ShortDescription</strong></td>
                                    <td>{{ $page->short_description }}</td>
                                </tr>
                               
                                </tbody>
                            </table>
                        </div>

                     
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@stop
