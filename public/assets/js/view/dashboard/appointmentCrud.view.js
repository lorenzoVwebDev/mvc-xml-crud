
export function renderNewTask(result, response) {
  if (response.status >= 200 && response.status<400) {
    const {title, description, duedate, priority} = result;
    const taskContainer = document.getElementById('task-list');
    const taskDiv = document.createElement('div');
    taskDiv.classList.add('task');
  
    taskDiv.innerHTML = `
      <div class="task-info">
        <strong>${title}</strong>
        <p>${description}</p>
        <small>Due: ${duedate}</small>
        <small>Priority: ${priority}</small>
      </div>
      <div class="task-actions">
        <button>Edit</button>
        <button>Delete</button>
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





