export async function insertTask(form, url) {
  const formData = new FormData(form);
  
  const response = await fetch(`${url}/admin/taskcrud/insert`, {
    method: 'POST',
    body: formData
  });

  if (response.status >= 200 && response.status < 400) {
    console.log(response)
    const result = await response.text()
    return {
      result,
      response
    }
  } else if (response.status >= 400 && response.status < 500) {
    const result = await response.json();
    return {
      result, response
    }
  }
}