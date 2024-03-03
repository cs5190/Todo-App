// functional request scripts, put them on a quick delay for reliability, as development goes on many delays get removed.
setTimeout(function() {
    typingEffect('#initial-welcome');
    setInputFocus();
    renderPageTasks();
    addActiveClassAndTypeEffect('#welcome-info-button', '#welcome-info');
    addActiveClassAndTypeEffect('#password-info-button', '#password-info');
    addActiveClassAndTypeEffect('#new-password-info-button', '#new-password-info');
    $('#archive-list').hide();
}, 50);

$(document).on('keydown', 'form input', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        $(this).closest('form').find('button').trigger('click');
    }
});

$(document).on('click', '#submit-username', function(event){
    event.preventDefault();
    var username = $('#username').val();
    if (username.length > 25) {
        openErrorModal('Username cannot be more than 25 characters');
        return;
    } else if (/\s/.test(username)) {
        openErrorModal('Username cannot contain spaces');
        return;
    }
    $('#submit-username').attr('disabled', 'disabled');
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
            setInputFocus();
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
    $.ajax({
        url:"index.php",
        method:"POST",
        data: {
            route: 'verifyLogin',
            payload: {
                password: password
            }
        },
        success:function(data)
        {
            console.log(data);  
            if (data == 1) {
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
                        $('#archive-list').hide();
                    }
                });
            } else {
                // Password is incorrect, show an error message
                openErrorModal('Incorrect password');
                return;
            }
        }
    })
});

$(document).on('click', '#back', function(event){
    event.preventDefault();
    location.reload(true);
});

$(document).on('click', '#register', function(event){
    event.preventDefault();
    var password = $('#password').val();
    var verifyPassword = $('#verify-password').val();
    var passwordRegex = /^(?=.*[0-9]|.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/;
    if (password != verifyPassword) {
        openErrorModal('Passwords do not match');
        return;
    } else if (!passwordRegex.test(password)) {
        openErrorModal('Password must be at least 8 characters and include a number or a special character');
        return;
    } else {
        $('#register').attr('disabled', 'disabled');
        $.ajax({
            url:"index.php",
            method:"POST",
            data: {
                route: 'create',
                payload: {
                    password: password
                }
            },
            success:function(data)
            {
                renderPageContent(data);
                $('#archive-list').hide();
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
            location.reload(true);
            setInputFocus();
        }
    })
});

$(document).on('click', '#archive', function(event){
    // Hide the todo list and show the archive list
    renderUserTasks();
    $('#task-list').hide();
    $('#archive-list').show();

    // Replace the archive button with a home button
    $(this).hide();
    $('#home').show();
});

// When the home button is clicked
$(document).on('click', '#home', function(event){
    // Hide the archive list and show the todo list
    renderUserTasks();
    $('#archive-list').hide();
    $('#task-list').show();

    // Replace the home button with an archive button
    $(this).hide();
    $('#archive').show();
});

$(document).on('click', '.archive-button', function(event){
    event.preventDefault();
    var taskId = $(this).data('id');
    console.log(taskId);
    var taskElement = $(this).closest('.list-group-item');
    $.ajax({
        url:"index.php",
        method:"POST",
        data: {
            route: 'tasks/archive',
            payload: {id: taskId}
        },
        success:function(data)
        {
            taskElement.remove();
        }
    })
});

$(document).on('click', '.restore-button', function(event){
    event.preventDefault();
    var taskId = $(this).data('id');
    console.log(taskId);
    var taskElement = $(this).closest('.list-group-item');
    $.ajax({
        url:"index.php",
        method:"POST",
        data: {
            route: 'tasks/restore',
            payload: {id: taskId}
        },
        success:function(data)
        {
            taskElement.remove();
        }
    })
});

$(document).on('click', '#about', function(event){
    event.preventDefault();
    $('#aboutModal').modal('show');
    typingEffect('#about-modal-title');
});

/* todo add input focus to the add task modal. doesnt work right */
$(document).on('click', '#add', function(event){
    //clear out the inputs in the add modal
    $('#task-label').val('');
    $('#task-description').val('');
    setCurrentDate();
    setFocus("#task-label", 500);
});

$(document).on('click', '#send-task-form', function(event){
    event.preventDefault();

    var task = {
        label: $('#task-label').val(),
        description: $('#task-description').val(),
        dueDate: $('#task-due-date').val()
    };

    if (task.label.length > 30) {
        alert('Label cannot be more than 30 characters');
        return;
    }

    if (task.description.length > 300) {
        alert('Description cannot be more than 300 characters');
        return;
    }

    $.ajax({
        url:"index.php",
        method:"POST",
        data: {
            route: 'tasks/add',
            payload: { task: task }
        },
        success:function(data)
        {
            appendTaskCard(task);
        }
    })
});

$(document).on('click', '#send-edit-task-form', function(event){
    event.preventDefault();

    var task = {
        taskId: $(this).data('id'),
        label: $('#edit-task-label').val(),
        description: $('#edit-task-description').val(),
        dueDate: $('#edit-task-due-date').val()
    };

    console.log(task);

    if (task.label.length > 30) {
        alert('Label cannot be more than 30 characters');
        return;
    }

    if (task.description.length > 300) {
        alert('Description cannot be more than 300 characters');
        return;
    }

    $.ajax({
        url:"index.php",
        method:"POST",
        data: {
            route: 'tasks/update',
            payload: { task: task }
        },
        success:function(data)
        {
            renderUserTasks();
        }
    })
});


$(document).on('click', '.edit-button', function(event){
    var taskId = $(this).data('id');
    var label = $(this).data('label'); 
    var description = $(this).data('description');
    var dueDate = $(this).data('due-date');
    $('#edit-task-label').val(label);
    $('#edit-task-description').val(description);
    $('#edit-task-due-date').val(dueDate);
    $('#send-edit-task-form').attr('data-id', taskId);
});

function setInputFocus() {
    setTimeout(function() {
        $('form input').first().trigger('focus');
    }, 100);
}

function setFocus(element, delay) {
    setTimeout(function() {
        $(element).trigger('focus');
    }, delay);
}

function openErrorModal(message) {
    $('#errorModal').modal('show');
    $('#errorModalBody').text(message);
}

function generateTaskCard(task) {
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    const taskDueDate = new Date(task.dueDate);
    taskDueDate.setHours(0, 0, 0, 0);

    const isPastDue = taskDueDate < today;
    const isDueToday = taskDueDate.getTime() === today.getTime();

    let card = '<li class="list-group-item border-0 bg-transparent">';
    card += '<div class="task card ' + (isPastDue ? 'past-due' : '') + (isDueToday ? 'due-today' : '') + (task.isArchived ? ' archived' : '') +'">';
    card += '<div class="card-body">';
    card += '<h5 class="card-title">' + task.label + '</h5>';
    card += '<p class="card-text">' + task.description + '</p>';
    card += '<p class="card-text due-date"><small>Due: ' + new Date(task.dueDate).toLocaleDateString() + '</small></p>';
    card += '</div>';
    if (task.isArchived) {
        card += '<button class="btn btn-secondary task-button restore-button" data-id="' + task.taskId + '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"';
        card +=  'class="bi bi-clipboard-plus" viewBox="0 0 16 16">';
        card += '<path fill-rule="evenodd" d="M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7"/>';
        card += '<path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z"/>';
        card += '<path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z"/>';
        card += '</svg></button>';
        card += '<button class="btn btn-danger task-button trash-button" data-id="' + task.taskId + '">';
        card += '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">';
        card += '<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>';
        card += '<path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059';
        card += 'V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/></svg></button>';
    } else {
        card += '<button class="btn btn-primary task-button archive-button" data-id="' + task.taskId + '">';
        card += '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">';
        card += '<path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z"/></svg></button>';
        card += '<button class="btn btn-primary task-button edit-button" data-id="' + task.taskId + '" data-label="' + task.label + '" data-description="' + task.description + '" data-due-date="' + task.dueDate + '" data-bs-toggle="modal" data-bs-target="#editTaskModal" aria-label="Edit task">';
        card += '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">';
        card += '<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/></svg></button>';
    }
    card += '</div></li>';
    return card;
}

$(document).on('click', '.trash-button', function() {
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
    if (task.isArchived) {
        $('#archive-list').append(generateTaskCard(task));
    } else {
        $('#task-list').append(generateTaskCard(task));
    }
}

function renderPageContent(data) {
    $('#mainPageContent').html(data);
    renderPageTasks();
}

function renderPageTasks() {
    setTimeout(function() {
        if ($('#tasks-page').length != 0) {
            setCurrentDate();
            renderUserTasks();
            typingEffect('#task-message');
        }
    }, 50);
}

function renderUserTasks() {
    $('#task-list').empty();
    $('#archive-list').empty();
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
            $.each(tasks, function(index, task) {
                appendTaskCard(task);
            });
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

function addActiveClassAndTypeEffect(buttonId, infoId) {
    $(document).on('click', buttonId, function(event){
        event.preventDefault();
        if (!$(buttonId).hasClass("clicked")) {
            $(buttonId).addClass("clicked");
            var descContainer = $(infoId).parent();
            descContainer.addClass('active');
            typingEffect(infoId);
        }
    });
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
