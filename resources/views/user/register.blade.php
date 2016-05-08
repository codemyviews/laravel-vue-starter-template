@extends('layouts/skeleton')

@section('content')

    <div class="container-fluid">
        <a href="{{ route('marketing.welcome') }}" class="app-brand m-b-lg">
            <img src="{{ asset('images/brand.png') }}" alt="brand">
        </a>

        <div class="row">
            <form class="form-horizontal" method="POST" action="">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    <div class="panel-body">
                        @if (isset($errors) && count($errors->default) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->default->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group">
                            <label class="col-md-4 control-label">Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control">
                            </div>
                        </div>

                        {{--<div class="form-group">--}}
                            {{--<label class="col-md-4 control-label">Team Name</label>--}}
                            {{--<div class="col-md-6">--}}
                                {{--<input type="text" class="form-control">--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        <div class="form-group">
                            <label class="col-md-4 control-label">E-Mail Address</label>
                            <div class="col-md-6">
                                <input required type="email" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Password</label>
                            <div class="col-md-6">
                                <input required type="password" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input required type="password" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-6 col-sm-offset-3">
                                <div class="checkbox">
                                    <label>
                                        <input required type="checkbox"> I Accept The <a href="/terms" target="_blank">Terms Of Service</a>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-6 col-sm-offset-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-check-circle"></i> Register
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
