@extends('cpanel::layouts')

@section('header')
    <h1>Wallets</h1>
@stop

@section('breadcrumb')
    @parent
    <li class="active"><i class="fa fa-user"></i> Wallets</li>
@stop

@section('content')

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <div class="btn-toolbar">
                            <a href="{{route('cpanel.wallets.create')}}" class="btn btn-primary"
                               data-toggle="tooltip" title="Create New Wallet">
                                <i class="fa fa-plus"></i>
                                New Wallet
                            </a>
                        </div>
                    </h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                           <!-- <th>Name</th>
                            <th class="hidden-xs">Email</th>
                            <th class="hidden-xs">Active</th>
                            <th class="hidden-xs">Joined</th>
                            <th class="hidden-xs">Last Visit</th>
                            <th>Action</th>-->
			    
                        </tr>
                        </thead>
                      <!--  <tbody>
                        @foreach ($wallets as $user)
                        <tr>
                            <td>{{ HTML::linkRoute('cpanel.users.show',$user->first_name.' '.$user->last_name, array($user->id)) }}</td>
                            <td class="hidden-xs">{{{ $user->email }}}</td>
                            <td class="hidden-xs">{{{ ($user->activated) ? 'yes' : 'no' }}}</td>
                            <td class="hidden-xs">{{{ $user->activated_at }}}</td>
                            <td class="hidden-xs">{{{ is_null($user->last_login) ? 'Never Visited' : $user->last_login }}}</td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
                                        Action
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('cpanel.users.show', array($user->id)) }}">
                                                <i class="fa fa-info-circle"></i>&nbsp;View User
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('cpanel.users.edit', array($user->id)) }}">
                                                <i class="fa fa-edit"></i>&nbsp;Edit User
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('cpanel.users.permissions', array($user->id)) }}">
                                                <i class="fa fa-ban"></i>&nbsp;Permissions
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('cpanel.users.destroy', array($user->id)) }}"
                                               data-method="delete"
                                               data-message="delete this User?">
                                                <i class="fa fa-trash-o"></i>&nbsp;Delete User
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            @if ($user->isActivated())
                                            <a href="{{ route('cpanel.users.deactivate', array($user->id)) }}"
                                               data-method="put"
                                               data-message="Deactivate this User?">
                                                <i class="fa fa-minus-circle"></i>&nbsp;Deactivate
                                            </a>
                                            @else
                                            <a href="{{ route('cpanel.users.activate', array($user->id)) }}"
                                               data-method="put"
                                               data-message="Activate this User?">
                                                <i class="fa fa-check"></i>&nbsp;Activate
                                            </a>
                                            @endif
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="{{ route('cpanel.users.throttling', array($user->id)) }}">
                                                <i class="fa fa-key"></i>&nbsp;Throttling
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
			<td>
			<a href="{{ route('cpanel.users.list_users', array($user->id)) }}">
                                                <i class="fa fa-user"></i>&nbsp;View Users
                                            </a>
			</td>
			<td>
			<a href="{{ route('cpanel.users.create_user', array($user->id)) }}">
                                                <i class="fa fa-user"></i>&nbsp;Create User
                                            </a>
			</td>
                        </tr>
			
                        @endforeach
                        </tbody>-->
                    </table>
                </div>
            </div>
        </div>
    </div>

@stop
