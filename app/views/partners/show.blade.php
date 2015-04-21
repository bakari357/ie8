@extends('cpanel::layouts')

@section('header')
    <h1>Partners</h1>
@stop

@section('breadcrumb')
@parent

<li>
    <a href="{{route('cpanel.partners.index')}}">
        <i class="fa fa-page"></i>
        Partners
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
                    {{ $partner->partner_name }} Partner
                </h3>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">
                <div class="tabbable">
                <span style="float:right;margin-bottom:10px;"><a class="btn btn-primary" href="{{route('cpanel.partners.index')}}">Cancel</a></span>

                    <div class="tab-content">

                        <div class="tab-pane active" id="info">
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                    <td><strong>Partner Name</strong></td>
                                    <td>{{ $partner->name }}</td>
                                </tr>
                                 <tr>
                                    <td><strong>Partner Email</strong></td>
                                    <td>{{ $partner->email }}</td>
                                </tr>
                                
                                 <tr>
                                    <td><strong>Partner code</strong></td>
                                    <td>{{ $partner->user_code }}</td>
                                </tr>

                                  <tr>
                                    <td><strong>Partner VAT</strong></td>
                                    <td>{{ $partner->vat}}</td>
                                </tr>


                                 <tr>
                                    <td><strong>Partner ST Number</strong></td>
                                    <td>{{ $partner->st_number}}</td>
                                </tr>



                                    
                                 <tr>
                                    <td><strong>Partner TIN Number</strong></td>
                                    <td>{{ $partner->tin_number}}</td>
                                </tr>

                                 
                                 <tr>
                                    <td><strong>Partner PAN</strong></td>
                                    <td>{{ $partner->pan}}</td>
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
