// functional request scripts
setTimeout(function() {
    typingEffect('#initial-welcome');
    findInputFocus();
    renderPageTasks();
    addActiveClassAndTypeEffect('#welcome-info-button', '#welcome-info');
    addActiveClassAndTypeEffect('#password-info-button', '#password-info');
    addActiveClassAndTypeEffect('#new-password-info-button', '#new-password-info');
}, 100);


$(document).on('keydown', 'form input', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        $(this).closest('form').find('button').trigger('click');
    }
});

function addActiveClassAndTypeEffect(buttonId, infoId) {
    $(document).on('click', buttonId, function(event){
        event.preventDefault();
        var descContainer = $(infoId).parent();
        descContainer.addClass('active');
        typingEffect(infoId);
    });
}

$(document).on('click', '#submit', function(event){
    event.preventDefault();
    var username = $('#username').val();
    if (username.length > 25) {
        openErrorModal('Username cannot be more than 25 characters');
        return;
    }
    $('#submit').attr('disabled', 'disabled');
    $.ajax({
        url:"index.php",
        method:"POST",
        data: {
            route: 'userExists',
            payload: {
                username: username
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
    var password = $('#password').val();
    var passwordRegex = /^(?=.*[0-9]|.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/;
    if (!passwordRegex.test(password)) {
        openErrorModal('Password must be at least 8 characters and include a number or a special character');
        return;
    }
    $('#login').attr('disabled', 'disabled');
    $.ajax({
        url:"index.php",
        method:"POST",
        data: {
            route: 'login',
            payload: {
                password: password
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
    if ($('#password').val() != $('#verify-password').val()) {
        alert('Passwords do not match');
        return;
    } else {
        $('#register').attr('disabled', 'disabled');
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
            location.reload(true);
            findInputFocus();
        }
    })
});

function renderPageContent(data) {
    $('#mainPageContent').html(data);
    renderPageTasks();
}

function findInputFocus() {
    setTimeout(function() {
        $('form input').first().trigger('focus');
    }, 100);
}

$(document).on('click', '#archive', function(event){
    event.preventDefault();
});

$(document).on('click', '#send-task-form', function(event){
    event.preventDefault();
    $.ajax({
        url:"index.php",
        method:"POST",
        data: {
            route: 'tasks/add',
            payload: {
                task: {
                    label: $('#task-label').val(),
                    description: $('#task-description').val(),
                    dueDate: $('#task-due-date').val()
                }
            }
        },
        success:function(data)
        {
            var task = {
                taskId: JSON.parse(data),
                label: $('#task-label').val(),
                description: $('#task-description').val(),
                dueDate: $('#task-due-date').val()
            };
            appendTaskCard(task);
        }
    })
});

function getDefaultTasks() {
    fetch('js/tasks.json')
        .then(response => response.json())
        .then(tasks => {
            $.each(tasks, function(index, task) {
                appendTaskCard(task);
            });
        })
        .catch(error => console.log('Error:', error));
}

function generateTaskCard(task) {
    return `
        <li class="list-group-item border-0">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title
                    ">${task.label}</h5>
                    <p class="card-text">${task.description}</p>
                    <p class="card-text"><small class="text-muted">Due: ${new Date(task.dueDate).toLocaleDateString()}</small></p>
                </div>
                <button id="trash-task" class="btn btn-danger" data-id="${task.taskId}">Trash</button>
            </div>
        </li>
    `;
}

$(document).on('click', '#trash-task', function() {
    var taskId = $(this).data('id');
    var taskElement = $(this).closest('.list-group-item');
    $.ajax({
        url:"index.php",
        method:"POST",
        data: {
            route: 'tasks/delete',
            payload: {id: taskId}
        },
        success:function(data)
        {
            taskElement.remove();
        }
    })
});

function appendTaskCard(task) {
    $('#todo-list').append(generateTaskCard(task));
}

function renderUserTasks() {
    $('#todo-list').html('');
    $.ajax({
        url:"index.php",
        method:"POST",
        data: {
            route: 'tasks/get',
            payload: {}
        },
        success:function(data)
        {
            var tasks = JSON.parse(data);
            if (!tasks || tasks.length == 0) {
                getDefaultTasks(); 
            } else {
                $.each(tasks, function(index, task) {
                    appendTaskCard(task);
                });
            }
        }
    })
}

function setCurrentDate() {
    var d = new Date();
    var strDate = d.getFullYear() + "-" + 
                  ("0" + (d.getMonth()+1)).slice(-2) + "-" + 
                  ("0" + d.getDate()).slice(-2);
    $('#task-due-date').val(strDate);
}

function renderPageTasks() {
    setTimeout(function() {
        if ($('#tasks-page').length != 0) {
            setCurrentDate();
            renderUserTasks();
            typingEffect('#task-message');
        }
    }, 100);
}

function typingEffect(elementId) {
    var text = $(elementId).text();
    $(elementId).text('');
    $(elementId).show();
    var speed =  100;
    if (text.length > 15) {
        speed -= (text.length);
    }
    var character = 0;

    $(elementId).append('<span class="blink">.</span>');

    function typeWriter() {
        if (character < text.length) {
            $(elementId).children('.blink').before(text.charAt(character));
            character++;
            setTimeout(typeWriter, speed);
        }
    }

    typeWriter();
}
