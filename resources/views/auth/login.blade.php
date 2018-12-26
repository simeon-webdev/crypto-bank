@extends('layouts.frontend')
@section('content')
    <div class="container">
        <div class="col-sm-6 col-sm-offset-3">
            <h1>Nexo Bank Sign In</h1>
            <div class="panel panel-primary">
                <div class="panel-heading">Sign In</div>
                <div class="panel-body">
                    {!! Form::open(['url' => route('login'), 'method' => 'POST']) !!}
                        <div class="form-group">
                            {!! Form::label('email', 'Email') !!}
                            {!! Form::text('email', null,
                                ['class' => 'form-control', 'placeholder' => 'Email', 'autofocus' => true]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('password', 'Password') !!}
                            {!! Form::password('password',
                                ['class' => 'form-control', 'placeholder' => 'Password']) !!}
                        </div>

                        @if(!$errors->isEmpty())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    {!! $error . '<br>' !!}
                                @endforeach
                            </div>
                        @endif

                        {!! Form::submit('Sign In') !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
