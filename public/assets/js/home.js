//services
import { insertTask } from './services/dashboard/appointmentCrud.js'
//views
import { renderNewTask } from './view/dashboard/appointmentCrud.view.js';
//global variables
import { url } from './utils/globalVariables.js'


const handleClick = (event) => {
  deleteTask(event)
}


document.getElementById('appointment-list').addEventListener('submit', async (event) => {
  try {
    event.preventDefault();
    const form = event.target;
    const responseObject = await insertTask(form, url);
    const { result, response } = responseObject;
    renderNewTask(result, response);
    document.querySelectorAll('.delete-task').forEach((element) => {
      element.removeEventListener('click', handleClick)
      element.addEventListener('click', handleClick)
    })
  } catch (err) {
    console.error(err);
  }
});



function deleteTask(event) {
  console.dir(event);
}

//Download exception log and render table
/* document.getElementById('log-form').addEventListener('submit', async (event) => {
  event.preventDefault();
  try {
    const type = event.target[0].value;  
    const date = event.target[1].value;  
    if (event.submitter.value === 'download') {
      const resultObject = await downloadLogFile(type, date, url);
      const {response, result} = resultObject;
      downloadLogFileView(response, result, type);
    } else if (event.submitter.value === 'show-table') {
      const { response, result} = await downloadTable(type, date, url);
      const table = createTableAndMail(response, result);
      appendDelete(table);
      attachDeleteListener(type, date, url)
    }
  } catch (error) {
    console.error(error)
  }
})

function attachDeleteListener(type, date, url) {
  document.querySelectorAll('.delete-log').forEach( element => {
    element.addEventListener('click', async () => {
      console.log('hello')
      await deleteLog(type, element, url);
      const {result, response} = await downloadTable(type, date, url);
      console.log(response)
      const table = createTableAndMail(response, result);
      console.log(table)
      appendDelete(table);
      attachDeleteListener(type, date, url, response)
    })
  })
} */































/* document.querySelectorAll('.log-form').forEach(element => {
  element.addEventListener('submit', async (event) => {
    event.preventDefault();
    try {
      const resultObject = await logEvent(event, url);
      const { result, type } = resultObject;
      const displayBool = appendButtons(result);
      if (!displayBool) throw new Error("Error 404");
        document.querySelector(`.${type}-download-button`).addEventListener('click', async (event) => {
        downloadLogFile(type, url) 
      })

      document.querySelector(`.${type}-table-button`).addEventListener('click', async (event) => {
        const result = await downloadTable(type, url);
        const table = createTableAndMail(result);
        appendDelete(table);
        attachDeleteListener(type, url)
      })
    } catch (err) {
      console.error(err)
    }
  })
})
//recursive function that call itself each time
function attachDeleteListener(type, url) {
  document.querySelectorAll('.delete-log').forEach( element => {
    element.addEventListener('click', async () => {
      await deleteLog(type, element, url);
      const result = await downloadTable(type, url);
      const table = createTableAndMail(result);
      appendDelete(table);
      attachDeleteListener(type, url)
    })
  })
} */