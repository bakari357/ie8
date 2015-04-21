@extends('cpanel::layouts')

@section('header')
    <h1>Partners</h1>
@stop

@section('breadcrumb')
    @parent
    <li class="active"><i class="fa fa-user"></i> Partners</li>
@stop

@section('content')

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <div class="btn-toolbar">
                            <a href="{{ route('cpanel.partners.create') }}" class="btn btn-primary"
                               data-toggle="tooltip" title="Create New Partner">
                                <i class="fa fa-plus"></i>
                                New Partner
                            </a>
                        </div>
                    </h3>
                </div>
             
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th class="hidden-xs">Partner Name</th>
                             <th class="hidden-xs">Email</th>
                             <th class="hidden-xs">Active</th>
                            <th class="hidden-xs">Created On</th>
                            <th class="hidden-xs">Updated On</th>
                            <th class="hidden-xs">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $customer)  
                        <tr> <?php  $partner=$customer->name;  $email=$customer->email;  ?>
                            <td>{{ HTML::linkRoute('cpanel.partners.show',$partner, array($customer->id)) }}</td>
                             <td>{{ HTML::linkRoute('cpanel.partners.show',$email, array($customer->id)) }}</td>
                              <td class="hidden-xs">{{{ ($customer->activated) ? 'yes' : 'no' }}}</td>
                            <td class="hidden-xs">{{{ $customer->created_at }}}</td>
                             <td class="hidden-xs">{{{ is_null($customer->last_login) ? 'Never Visited' : $customer->last_login }}}</td>
                           
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
                                        Action
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('cpanel.partners.show', array($customer->id)) }}">
                                                <i class="fa fa-info-circle"></i>&nbsp;View Partner
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('cpanel.partners.edit', array($customer->id)) }}">
                                                <i class="fa fa-edit"></i>&nbsp;Edit Partner 
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('cpanel.partners.destroy', array($customer->id)) }}"
                                               data-method="delete"
                                               data-message="delete this Customer?">
                                                <i class="fa fa-trash-o"></i>&nbsp;Delete Partner
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                     
                                       
                                    </ul>
                                </div>
                            </td>
			<td>
					<a href="{{ route('cpanel.users.list_users', array($customer->id)) }}">
                                                <i class="fa fa-user"></i>&nbsp;View Users
                                            </a>
			</td>
			<td>
			<a href="{{ route('cpanel.users.create_user',array($customer->id)) }}">
                                                <i class="fa fa-user"></i>&nbsp;Create User
                                            </a>	
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
