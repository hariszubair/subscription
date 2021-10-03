@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Website Subscription') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <!-- <form action="/api/subscribe_user" method="POST"> -->
                    <form action="/subscribe_user" method="POST">

                        @csrf
                        <select name="website" id="website" class="form-control" required>
                            <option value="">Please select a website</option>
                            @foreach($websites as $website)
                            <option value="{{$website->id}}">{{$website->name}}</option>
                            @endforeach
                        </select>
                        <Button style="margin-top: 20px;" class="btn btn-success" class="form-control">Subscribe</Button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection