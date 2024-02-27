// functional request scripts

findInputFocus();

$(document).on('keydown', 'form input', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        $(this).closest('form').find('button').trigger('click');
    }
});

$(document).on('click', '#submit', function(event){
    event.preventDefault();
    $('#submit').attr('disabled', 'disabled');
    $.ajax({
        url:"index.php",
        method:"POST",
        data: {
            route: 'userExists',
            payload: {
                username: $('#username').val()
            }
        },
        success:function(data)
        {
            renderPageContent(data);
            findInputFocus();
        }
    })
});

$(document).on('click', '#login', function(event){
    event.preventDefault();
    $('#login').attr('disabled', 'disabled');
    $.ajax({
        url:"index.php",
        method:"POST",
        data: {
            route: 'login',
            payload: {
                password: $('#password').val()
            }
        },
        success:function(data)
        {
            renderPageContent(data);
        }
    })
});

$(document).on('click', '#back', function(event){
    event.preventDefault();
    location.reload(true);
});

$(document).on('click', '#register', function(event){
    event.preventDefault();
    $('#register').attr('disabled', 'disabled');
    var verify = $('#verify-password').val();
    if (password != verify) {
        alert('Passwords do not match');
        return;
    } else {
        $.ajax({
            url:"index.php",
            method:"POST",
            data: {
                route: 'create',
                payload: {
                    password: $('#password').val()
                }
            },
            success:function(data)
            {
                renderPageContent(data);
            }
        });
    }
});

$(document).on('click', '#logout', function(event){
    event.preventDefault();
    $.ajax({
        url:"index.php",
        method:"POST",
        data: {
            route: 'logout',
            payload: {}
        },
        success:function(data)
        {
            renderPageContent(data);
            findInputFocus();
        }
    })
});

function renderPageContent(data) {
    $('#mainPageContent').html(data);
}

function findInputFocus() {
    setTimeout(function() {
        $('form input').first().trigger('focus');
    }, 100);
}
