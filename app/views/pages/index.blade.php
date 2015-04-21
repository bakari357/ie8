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
                            <a href="{{ route('cpanel.pages.create') }}" class="btn btn-primary"
                               data-toggle="tooltip" title="Create New Page">
                                <i class="fa fa-plus"></i>
                                New Page
                            </a>
                        </div>
                    </h3>
                </div>
               <?php echo $pages->links(); ?>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>

                            <th>Name</th>
                            <th class="hidden-xs">Short Description</th>
                            <th class="hidden-xs">Active</th>
                            <th class="hidden-xs">Created On</th>
                            <th class="hidden-xs">Updated On</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($pages as $page)
                        <tr>
                            <td>{{ HTML::linkRoute('cpanel.pages.show',$page->title, array($page->id)) }}</td>
                            <td class="hidden-xs">{{{ $page->short_description }}}</td>
                            <td class="hidden-xs">{{{ ($page->active) ? 'yes' : 'no' }}}</td>
                            <td class="hidden-xs">{{{ $page->created_at }}}</td>
                            <td class="hidden-xs">{{{ $page->updated_at }}}</td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
                                        Action
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('cpanel.pages.show', array($page->id)) }}">
                                                <i class="fa fa-info-circle"></i>&nbsp;View Page
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('cpanel.pages.edit', array($page->id)) }}">
                                                <i class="fa fa-edit"></i>&nbsp;Edit Page
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('cpanel.pages.destroy', array($page->id)) }}"
                                               data-method="delete"
                                               data-message="delete this Page?">
                                                <i class="fa fa-trash-o"></i>&nbsp;Delete Page
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            @if ($page->isActivated())
                                            <a href="{{ route('cpanel.pages.deactivate', array($page->id)) }}"
                                               data-method="put"
                                               data-message="Deactivate this Page?">
                                                <i class="fa fa-minus-circle"></i>&nbsp;Deactivate
                                            </a>
                                            @else
                                            <a href="{{ route('cpanel.pages.activate', array($page->id)) }}"
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
