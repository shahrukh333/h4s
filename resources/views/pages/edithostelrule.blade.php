@extends('layouts.app')

@section('content')
@include('includes.sidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myHostel', ['id' => encrypt(session('hostel')->id)]) }}">{{session('hostelName')}}</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/Rules') }}">Rules</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Hostel Rules</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                    <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">Edit Hostel Rules</h4></div>
                    <div class="container">
                            <div class="container">
                                <div class="form-group">
                                    <label class="text-info">Rule No 1</label>
                                    <textarea class="form-control" rows="1" name="rule1" placeholder="enter rule no 1">{{$rules->rule_1}}</textarea>
                                    <span id="rule1Span" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label class="text-info">Rule No 2</label>
                                    <textarea class="form-control" rows="1" name="rule2" placeholder="enter rule no 1">{{$rules->rule_2}}</textarea>
                                    <span id="rule2Span" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label class="text-info">Rule No 3</label>
                                    <textarea class="form-control" rows="1" name="rule3" placeholder="enter rule no 1">{{$rules->rule_3}}</textarea>
                                    <span id="rule3Span" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label class="text-info">Rule No 4</label>
                                    <textarea class="form-control" rows="1" name="rule4" placeholder="enter rule no 4">{{$rules->rule_4}}</textarea>
                                    <span id="rule4Span" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label class="text-info">Rule No 5</label>
                                    <textarea class="form-control" rows="1" name="rule5" placeholder="enter rule no 5">{{$rules->rule_5}}</textarea>
                                    <span id="rule5Span" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label class="text-info">Rule No 6</label>
                                    <textarea class="form-control" rows="1" name="rule6" placeholder="enter rule no 6">{{$rules->rule_6}}</textarea>
                                    <span id="rule6Span" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label class="text-info">Rule No 7</label>
                                    <textarea class="form-control" rows="1" name="rule7" placeholder="enter rule no 7">{{$rules->rule_7}}</textarea>
                                    <span id="rule7Span" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label class="text-info">Rule No 8</label>
                                    <textarea class="form-control" rows="1" name="rule8" placeholder="enter rule no 8">{{$rules->rule_8}}</textarea>
                                    <span id="rule8Span" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label class="text-info">Rule No 9</label>
                                    <textarea class="form-control" rows="1" name="rule9" placeholder="enter rule no 9">{{$rules->rule_9}}</textarea>
                                    <span id="rule9Span" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label class="text-info">Rule No 10</label>
                                    <textarea class="form-control" rows="1" name="rule10" placeholder="enter rule no 10">{{$rules->rule_10}}</textarea>
                                    <span id="rule10Span" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label class="text-info">Rule No 11*</label>
                                    <textarea class="form-control" rows="1" name="rule11" placeholder="enter rule no 11">{{$rules->rule_11}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label class="text-info">Rule No 12*</label>
                                    <textarea class="form-control" rows="1" name="rule12" placeholder="enter rule no 12">{{$rules->rule_12}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label class="text-info">Rule No 13*</label>
                                    <textarea class="form-control" rows="1" name="rule13" placeholder="enter rule no 13">{{$rules->rule_13}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label class="text-info">Rule No 14*</label>
                                    <textarea class="form-control" rows="1" name="rule14" placeholder="enter rule no 14">{{$rules->rule_14}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label class="text-info">Rule No 15*</label>
                                    <textarea class="form-control" rows="1" name="rule15" placeholder="enter rule no 15">{{$rules->rule_15}}</textarea>
                                </div>
                                <p class="text-info">*You may skip these rules if you want</p>
                                <input  type="hidden" name="token" value="{{Session::token()}}"/>
                                <input type="hidden" value="{{$rules->id}}" name="ruleId"/>
                                <button class="btn btn-primary" id="updateRuleBtn">Update<i class="fa fa-save fa-lg ml-2"></i></button>
                                <img id="myLoader" class="ml-2" src="{{ url('graphics/loader2.gif') }}" width="40" height="40"/>
                            <div id="success"></div>
                            </div>
                        <div class="mt-5"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    function editRules()
    {
        var ruleId = $('input[name = ruleId]').val();
        var rule = $('textarea[name = rule]').val();
        var token = '{{Session::token()}}';
        
        var message = '<div class="alert alert-success mt-5" role="alert">rules successfully updated</div>';
        
        if(rule === '')
        {
            $('#ruleSpan').html('please enter rule');
        }
        else 
        {
            $.post("{{ url('updateRules') }}",{rule:rule, ruleId:ruleId, _token:token}, function(data){
                $('#text').val(''); 
                $('#success').html(message);
            });  
        } 
    }
</script>

