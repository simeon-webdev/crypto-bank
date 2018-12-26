var socket = io('http://localhost:3000', {transports: ['websocket', 'polling', 'flashsocket']});
var $form = $('.ajax-form');
var $loading = $('.loading');

socket.on("account:App\\Events\\AccountDeposit", function(message){
    $('#amount').val('');
    $('#account_' + message.data.account.id + ' > span').fadeOut()
        .text(message.data.account.balance).fadeIn().css({
        'color': 'green',
        'font-weight': '700'
    });
});

socket.on('accrual:App\\Events\\DailyAccrual', function(message){
    $form.find('input').prop('disabled', false);
    $form.find('select').prop('disabled', false);

    $.each(message.data.accounts, function(key, account){
        $('#account_' + account.id + ' > span')
            .fadeOut().text(account.balance).fadeIn().css(
            {
                'color': 'green',
                'font-weight': '700'
            }
        );

    });

    $loading.hide();
});

socket.on('accrual:App\\Events\\DailyAccrualStatus', function(message){
    if (message.data.status === 'start') {
        $loading.show();
        $form.find('input').prop('disabled', true);
        $form.find('select').prop('disabled', true);
    } else {
        $loading.hide();
        $form.find('input').prop('disabled', false);
        $form.find('select').prop('disabled', false);
    }
});

socket.on('accrual:App\\Events\\Report', function(message){
    var $reportWrapper = $('.report-wrapper');

    var table = '<table class="table table-bordered">';
    table += '<tr><td>Date</td><td>'+message.data.report.date+'</td></tr>';
    table += '<tr><td>Deposits Count</td><td>'+message.data.report.depositsCount+'</td></tr>';
    table += '<tr><td>Deposits Amount BGN</td><td>'+message.data.report.depositAmountBgn+'</td></tr>';
    table += '<tr><td>Deposits Amount USD</td><td>'+message.data.report.depositAmountUsd+'</td></tr>';
    table += '<tr><td>Accrued Accounts</td><td>'+message.data.report.accruedAccounts+'</td></tr>';
    table += '<tr><td>Accrued Amount BGN</td><td>'+message.data.report.accruedAmountBgn+'</td></tr>';
    table += '<tr><td>Accrued Amount USD</td><td>'+message.data.report.accruedAmountUsd+'</td></tr>';

    $reportWrapper.html('<div class="alert alert-success">'+table+'</div>');
});