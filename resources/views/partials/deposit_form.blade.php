{!! Form::open(['url' => route('deposit'),
                'method' => 'POST',
                'class' => 'panel panel-info ajax-form']) !!}
    <div class="panel-heading">
        <h4>Deposit</h4>
    </div>
    <div class="panel-body">
        <div class="form-group">
            @if(Auth::check())
                {!! Form::hidden('user', Auth::user()->id, ['id' => 'user']) !!}
            @else
                {!! Form::label('user', 'User') !!}
                {!! Form::select('user', $usersList, null, ['class' => 'form-control select2']) !!}
            @endif
        </div>

        <div class="form-group">
            {!! Form::label('account', 'Account') !!}
            {!! Form::select('account', [], null, ['class' => 'form-control select2',]) !!}
        </div>


        <div class="form-group">
            {!! Form::label('amount', 'Amount') !!}

            <div class="input-group">
                <span class="input-group-addon">
                    BGN
                </span>
                {!! Form::text('amount', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="wrapper-height">
            <div class="success-wrapper"></div>
            <div class="error-wrapper"></div>
        </div>
        <div class="form-group">
            {!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}
        </div>
    </div>
{!! Form::close() !!}
