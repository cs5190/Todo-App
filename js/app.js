// functional request scripts

findInputFocus();
renderPageTasks()

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
        }
    }, 100);
    
}
