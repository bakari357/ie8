@extends('cpanel::layouts')

@section('header')
    <h1>Merchants</h1>
@stop

@section('breadcrumb')
    @parent
    <li class="active"><i class="fa fa-user"></i> Merchants</li>
@stop

@section('content')

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <div class="btn-toolbar">
                            <a href="{{ route('cpanel.merchants.create') }}" class="btn btn-primary"
                               data-toggle="tooltip" title="Create New merchant">
                                <i class="fa fa-plus"></i>
                                New Merchant
                            </a>
                        </div>
                    </h3>
                </div>
              
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th class="hidden-xs">Merchant Name</th>
                            <th class="hidden-xs">Email</th>
                             <th class="hidden-xs">Active</th>
                            <th class="hidden-xs">Created On</th>
                            <th class="hidden-xs">Created by</th>
			     <th class="hidden-xs">Approved by</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($customers as $customer)
                       <tr> <?php $mer=$name=$customer->name; $email=$customer->email; $active=$customer->activated;?>
                             <td>{{ HTML::linkRoute('cpanel.merchants.show',$mer, array($customer->id)) }}</td>
                            <td>{{ HTML::linkRoute('cpanel.merchants.show',$email, array($customer->id)) }}</td>
                             <td class="hidden-xs">{{{ ($customer->status) ? 'yes' : 'no' }}}</td>
                            <td class="hidden-xs">{{{ $customer->created_at }}}</td>
                            <td class="hidden-xs">{{{ $customer->created_by }}}</td> 
				 <td class="hidden-xs">{{{ $customer->approved_by }}}</td> 
                            <td> 
                                <div class="btn-group">
                                    <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
                                        Action
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('cpanel.merchants.show', array($customer->id)) }}">
                                                <i class="fa fa-info-circle"></i>&nbsp;View Merchant
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('cpanel.merchants.edit', array($customer->id)) }}">
                                                <i class="fa fa-edit"></i>&nbsp;Edit Merchant
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('cpanel.merchants.deactivate', array($customer->id)) }}"
                                               data-method="delete"
                                               data-message="delete this Customer?">
                                                <i class="fa fa-trash-o"></i>&nbsp;Delete Merchant
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                      <li>
                                            @if ($customer->status)
                                            <a href="{{ route('cpanel.merchants.deactivate', array($customer->id)) }}"
                                               data-method="put"
                                               data-message="Deactivate this User?">
                                                <i class="fa fa-minus-circle"></i>&nbsp;Deactivate
                                            </a>
                                            @else
                                            <a href="{{ route('cpanel.merchants.activate', array($customer->id)) }}"
                                               data-method="put"
                                               data-message="Activate this User?">
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
