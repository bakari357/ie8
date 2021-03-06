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
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <div class="btn-toolbar">
                            <a href="{{ route('cpanel.widget.create') }}" class="btn btn-primary"
                               data-toggle="tooltip" title="Create New Page">
                                <i class="fa fa-plus"></i>
                                New Page
                            </a>
                        </div>
                    </h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>

                            <th>Name</th>
                            <th class="hidden-xs">Short Description</th>
                            <th class="hidden-xs">Region</th>
                             <th class="hidden-xs">Position</th>
                            <th class="hidden-xs">Active</th>
                            <th class="hidden-xs">Created On</th>
                            <th class="hidden-xs">Updated On</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($widget as $banners)
                        <tr>
                            <td>{{ HTML::linkRoute('cpanel.pages.show',$banners->name, array($banners->id)) }}</td>
                            <td class="hidden-xs">{{{ $banners->description }}}</td>
				<td class="hidden-xs">{{{ $banners->region }}}</td>
				<td class="hidden-xs">{{{ $banners->position }}}th</td>
                            <td class="hidden-xs">{{{ ($banners->active) ? 'yes' : 'no' }}}</td>
                            <td class="hidden-xs">{{{ $banners->created_at }}}</td>
                            <td class="hidden-xs">{{{ $banners->updated_at }}}</td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
                                        Action
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('cpanel.widget.show', array($banners->id)) }}">
                                                <i class="fa fa-info-circle"></i>&nbsp;View Page
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('cpanel.widget.edit', array($banners->id)) }}">
                                                <i class="fa fa-edit"></i>&nbsp;Edit Page
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('cpanel.widget.destroy', array($banners->id)) }}"
                                               data-method="delete"
                                               data-message="delete this Page?">
                                                <i class="fa fa-trash-o"></i>&nbsp;Delete Page
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            @if ($banners->isActivated())
                                            <a href="{{ route('cpanel.widget.deactivate', array($banners->id)) }}"
                                               data-method="put"
                                               data-message="Deactivate this Page?">
                                                <i class="fa fa-minus-circle"></i>&nbsp;Deactivate
                                            </a>
                                            @else
                                            <a href="{{ route('cpanel.widget.activate', array($banners->id)) }}"
                                               data-method="put"
                                               data-message="Activate this Page?">
                                                <i class="fa fa-check"></i>&nbsp;Activate
                                            </a>
                                            @endif
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
