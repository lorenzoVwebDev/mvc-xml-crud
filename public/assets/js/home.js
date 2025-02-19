//services
import { insertTas, readTask } from './services/dashboard/appointmentCrud.js'
//views
import { renderNewTask } from './view/dashboard/appointmentCrud.view.js';
//global variables
import { url } from './utils/globalVariables.js'




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


document.getElementById('read-task').addEventListener('click', async (event) => {
  const responseObject = await readTask(url);

  console.log(responseObject)
})






























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