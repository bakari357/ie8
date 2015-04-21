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
                            <a href="{{ route('cpanel.pages.createtemp') }}" class="btn btn-primary"
                               data-toggle="tooltip" title="Create New Page">
                                <i class="fa fa-plus"></i>
                                Add new Template
                            </a>
				 <a href="{{ route('cpanel.pages.changeactive') }}" class="btn btn-primary"
                               data-toggle="tooltip" title="Create New Page">
                                <i class="fa fa-plus"></i>
                                 Make Template Active 
                            </a>
                        </div>
                    </h3>
                </div>
               <?php echo $template->links(); ?>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>

                            <th>Name</th>
                            <th class="hidden-xs">Region</th>
                            <th class="hidden-xs">Active</th>
                            <th class="hidden-xs">Created On</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($template as $page)
                        <tr>
                            <td>{{ HTML::linkRoute('cpanel.pages.show',$page->templ_name, array($page->id)) }}</td>
                            <td class="hidden-xs">{{ $page->region }}</td>
                            <td class="hidden-xs">{{{ ($page->active) ? 'yes' : 'no' }}}</td>
                            <td class="hidden-xs">{{{ $page->created_at }}}</td>
                            
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@stop
