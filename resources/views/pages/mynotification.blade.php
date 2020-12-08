@extends('layouts.app')

@section('content')
@include('includes.bsidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myBooking') }}">My Booking</a></li>
            <li class="breadcrumb-item active" aria-current="page">Notifications</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">Notifications</h4></div>
                <div class="card-body" style="min-height: 400px;">
                @if(count($notification) > 0)
                    @if(count($notification) > 1)
                        @foreach($notification as $notif)
                            <div class="container p-3">
                                <div class="well mt-3">
                                    <h4>Notification</h4>
                                    <p>{{$notif->notification}}</p>
                                    <p>Notification time <span class="text-primary">{{$notif->created_at}}</span></p>
                                    @if($notif->type === 'MessMenu')
                                      <a href="{{ url('/getMyMess',['id' => encrypt($notif->id)]) }}" class="btn btn-primary">View Mess Menu<i class="fa fa-cutlery fa-lg ml-2"></i></a>
                                    @elseif($notif->type === 'Rule')
                                      <a href="{{ url('/getMyRules',['id' => encrypt($notif->id)]) }}" class="btn btn-primary">View Rules<i class="fa fa-bullhorn fa-lg ml-2"></i></a>
                                    @elseif($notif->type === 'Query')
                                      <a href="{{ url('/myQueryReply',[encrypt($notif->id)]) }}" class="btn btn-primary">View Reply<i class="fa fa-question-circle fa-lg ml-2"></i></a>
                                    @elseif($notif->type === 'Complaint')
                                      <a href="{{ url('/myComplaintReply',[encrypt($notif->id)]) }}" class="btn btn-primary">View Reply<i class="fa fa-eye fa-lg ml-2"></i></a>
                                    @elseif($notif->type === 'Dues')
                                      <a href="{{ url('/myDuesNotification',[encrypt($notif->id)]) }}" class="btn btn-primary">View Dues<i class="fa fa-money fa-lg ml-2"></i></a>
                                    @endif
                                </div>
                            </div>
                            <hr>
                        @endforeach
                        
                    @else 
                        <div class="container p-3">
                            <div class="well mt-3">
                                <div class="well mt-3">
                                    <h4>Notification</h4>
                                    <p>{{$notification->first()->notification}}</p>
                                    <p>Notification time <span class="text-primary">{{$notification->first()->created_at}}</span></p>
                                    @if($notification->first()->type === 'MessMenu')
                                        <a href="{{ url('/getMyMess',['id' => encrypt($notification->first()->id)]) }}" class="btn btn-primary">view mess menu<i class="fa fa-cutlery fa-lg ml-2"></i></a>
                                    @elseif($notification->first()->type === 'Rule')
                                        <a href="{{ url('/getMyRules',['id' => encrypt($notification->first()->id)]) }}" class="btn btn-primary">View Rules<i class="fa fa-bullhorn fa-lg ml-2"></i></a>
                                    @elseif($notification->first()->type === 'Query')
                                        <a href="{{ url('/myQueryReply',[encrypt($notification->first()->id)]) }}" class="btn btn-primary">View Reply<i class="fa fa-question-circle fa-lg ml-2"></i></a>
                                    @elseif($notification->first()->type === 'Complaint')
                                        <a href="{{ url('/myComplaintReply',[encrypt($notification->first()->id)]) }}" class="btn btn-primary">View Reply<i class="fa fa-eye fa-lg ml-2"></i></a>
                                    @elseif($notification->first()->type === 'Dues')
                                        <a href="{{ url('/myDuesNotification',[encrypt($notification->first()->id)]) }}" class="btn btn-primary">View Dues<i class="fa fa-Money fa-lg ml-2"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                    
                @else 
                    <div class="font-weight-bold text-center pt-5 pb-5 h5 mt-5">
                        <li class="fa fa-exclamation-circle fa-lg text-primary mr-1"></li>There are no notifications to show
                    </div>
                @endif
                <div class="row col-md-12 col-sm-12 ml-1">
                    {!! $notification->appends(Request::all())->render()!!}
                </div>
                <div class="mt-5"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

