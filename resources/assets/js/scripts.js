$(function () {

    $('.select2').select2();

    populateAccounts();
});

$('.ajax-form').on('submit', function(event){
    event.preventDefault();

    var $this = $(this);
    var action = $this.attr('action');
    var method = $this.attr('method');
    var data = $this.serialize();

    var $successWrapper = $('.success-wrapper');
    var $errorWrapper = $('.error-wrapper');

    $.ajax({
        url: action,
        method: method,
        data: data,
        type: "json",
        success: function(response){
            $errorWrapper.hide();
            $successWrapper.fadeIn();

            $successWrapper.html('<div class="alert alert-success">'+response+'</div>');

            setTimeout(function(){
                $successWrapper.fadeOut(1000);
            }, 3000);
        },
        error: function(response){
            $successWrapper.hide();
            $errorWrapper.fadeIn();

            var errors = '';
            $.each(response.responseJSON.errors, function(key, value){
                errors += value[0] + ' <br> ';
            });

            $errorWrapper.html('<div class="alert alert-danger">'+errors+'</div>');

            setTimeout(function(){
                $errorWrapper.fadeOut(1000);
            }, 3000);
        }
    });
});

$('.daily_accrual').on('click', function (event) {
    event.preventDefault();

    var $this = $(this);

    $.get({
        url: $this.attr('href')
     });
});

$('#user').on('change', function(){
    populateAccounts();
});

function populateAccounts()
{
    var userId = $('#user').val();

    $.ajax({
        url: baseUrl + '/user_accounts',
        method: 'GET',
        data: {'user_id': userId, '_token': _token},
        success: function(response){
            $('#account').empty().select2({data: response.result});
        }
    });
}
