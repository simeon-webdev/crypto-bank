@extends('layouts.frontend')

@section('content')

    <div class="col-sm-8">
        @include('partials.deposit_form')
    </div>
    <div class="col-sm-4">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4>Actions</h4>
            </div>
            <div class="panel-body">
                <a href="{{ route('daily_accrual') }}" class="btn btn-info col-sm-12 daily_accrual">Daily Accrual</a>
                <hr>
                <a href="{{ route('daily_accrual', ['unlimited' => true]) }}"
                   class="btn btn-info col-sm-12 daily_accrual">Unlimited Accrual</a>
            </div>
        </div>

        <div class="panel panel-success">
            <div class="panel-heading">
                <h4>Daily Report</h4>
            </div>
            <div class="panel-body">
                <div class="report-wrapper">

                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4>Accounts</h4>
            </div>
            <table class="table table-bordered table-striped table-responsive">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Account Balance</th>
                        <th>Account Address</th>
                        <th>Interest Rate</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($accounts as $account)
                        <tr>
                            <td>{{ $account->user[0]->name }}</td>
                            <td>{{ $account->user[0]->email }}</td>
                            <td id="account_{{ $account->id }}"><span>{{ $account->balance }}</span> BGN</td>
                            <td>{{ $account->address }}</td>
                            <td>{{ $account->interestRate->percent }} %</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
