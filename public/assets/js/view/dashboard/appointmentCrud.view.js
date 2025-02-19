
export function renderNewTask(result, response) {
  if (response.status >= 200 && response.status<400) {
    const {title, description, duedate, priority} = result;
    const taskContainer = document.getElementById('tasklist');
    const taskDiv = document.createElement('div');
    taskDiv.classList.add('task');
  
    taskDiv.innerHTML = `
      <div class="task-info">
        <strong>${title}</strong>
        <p>${description}</p>
        <small>Due: ${duedate}</small>
        <small>Priority: ${priority}</small>
      </div>
      <div class="task-actions" data-id=${Date.now()}>
        <button class="update-task">Edit</button>
        <button class="delete-task">Delete</button>
      </div>  
    `
  
    taskContainer.append(taskDiv);
  } else if (response.status >= 400 && response.status < 500) {
    var modal = document.querySelector('.modal-container');
    modal.style.display = 'block';
    var modalTitle = document.getElementById('modal-title');
    var modalText = document.getElementById('modal-text');
    modalTitle.innerText = `Error ${result.status.toString()}`;
    modalText.innerHTML = `${result.message}`;
  } else if (response.status >= 500) {
    var modal = document.querySelector('.modal-container');
    modal.style.display = 'block';
    var modalTitle = document.getElementById('modal-title');
    var modalText = document.getElementById('modal-text');
    modalTitle.innerText = `Error ${result.status.toString()}`;
    modalText.innerHTML = `${result.message}`;
  }
}

export function renderStoredTask(result, response) {
  if (response.status >= 200 && response.status<400) {
    const taskContainer = document.getElementById('tasklist');
    taskContainer.innerHTML = '';

    result.forEach(element => {
      const task = `
      <div class="task-info">
        <strong>${element.title}</strong>
        <p>${element.description}</p>
        <small>Due: ${element.duedate}</small>
        <small>Priority: ${element.priority}</small>
      </div>
      <div class="task-actions" data-id=${element.id}>
        <button class="update-task">Edit</button>
        <button class="delete-task">Delete</button>
      </div>  
    `
      taskContainer.append(task);
    })
  } else if (response.status >= 400 && response.status < 500) {

  } else if (response.status >= 500) {

  }
}





