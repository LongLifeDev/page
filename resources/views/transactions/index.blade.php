@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center text-uppercase font-weight-bold">
                        <b>Transactions</b>
                    </div>
                    <div class="panel-body">
                                @if(count($transactions) > 0) 
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-dark table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col"><span class="glyphicon glyphicon-leaf" style="font-size:1em;color:green"></span></th>
                                                <th scope="col">Date</th>
                                                <th scope="col">User</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Address</th>
                                                <th scope="col">City</th>
                                                <th scope="col">State</th>
                                                <th scope="col">Zip</th>
                                                <th scope="col">Transaction#</th>
                                                <th scope="col">Ammount</th>
                                                <th scope="col">Paid</th>
                                                <th scope="col">Shipped</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                             @foreach($transactions as $transaction)
                                            <tr>
                                                <th scope="row"><span class="glyphicon glyphicon-certificate" style="font-size:1em;"></span></th>
                                                <td>{{$transaction->created_at}}</td>
                                                <td>{{$transaction->user_id}}</td>
                                                <td>{{$transaction->user_email}}</td>
                                                <td>{{$transaction->user_name}}</td>
                                                <td>{{$transaction->address_1}}</td>
                                                <td>{{$transaction->city}}</td>
                                                <td>{{$transaction->state}}</td>
                                                <td>{{$transaction->zip}}</td>
                                                <td>{{$transaction->trnsctn_id}}</td>
                                                <td>${{$transaction->ammount}}</td>
                                                <td>{{$transaction->paid}}</td>
                                                <td>{{$transaction->shipped}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody> 
                                    </table>
                                </div>
                                    <span class="" style="font-size: 9px;">{{$transactions->links()}}</span>   
                                    <br/> 
                                @endif
                            </div>
                        
                        
                    
                </div>
            </div>
        </div>
    </div>

@endsection