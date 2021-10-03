@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Publish a Post') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <!-- <form action="api/submit_post" method="POST"> -->
                    <form action="/submit_post" method="POST">
                        @csrf
                        <div class="form-group">
                            <select name="website" id="website" class="form-control" required>
                                <option value="">Please select a website</option>
                                @foreach($websites as $website)
                                <option value="{{$website->id}}">{{$website->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Post Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Post Description</label>
                            <textarea type="text" class="form-control" id="description" name="description"></textarea>
                        </div>
                        <Button style="margin-top: 20px;" class="btn btn-success" class="form-control">Subscribe</Button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection