<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>MVC-dog-application</title>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/headers/">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
  <link href="<?=ROOT?>public/assets/bootstrap.assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?=ROOT?>public/assets/css/home.css"/>
  <link rel="stylesheet" href="<?=ROOT?>public/assets/css/common.css"/>
</head>
<body>
  <section class="git-header-section"></section>
  <section class="main-header">
    </section>

  <section class="main-section">
    <section class="mail-section">
      <h3>Send events table to the admin's mail</h3>      
      <form id="mail-form">
          <div class="input-container">
            <label class="name">
              Name
              <input type="text" placeholder="Insert your name" pattern="[A-Za-z]+" minlenght="5" maxlenght="25" name="name" value="<?=ADMINNAME?>" required />
            </label>
            <label class="surname">
              Surname
              <input type="text" placeholder="Insert your Surname" pattern="[A-Za-z]+" minlenght="5" maxlenght="25" name="surname" value="<?=ADMINSURNAME?>"required/>
            </label>
            <label class="birthdate">
              Log Date
              <input type="date" name="log-date" id="log-date" value="<?=date('Y-m-d')?>"/>
            </label>
            <label class="social">
              Log Table
              <select id="mail-form" name="type">
                <option value="exception" selected>Exception</option>
                <option value="error">Error</option>
                <option value="access">Access</option>
              </select>
            </label>
            <label> 
              e-mail
              <input type="email" placeholder="insert your mail" name="email" value="<?=ADMINMAIL?>"required/>
            </label>
            <input type="text" value="table-mail" id="mail" name="form-hidden" hidden/>
            <input type="submit" value="Submit"/>
          </div>
        </form>
    </section>

    <section class="logs-section">
      <h3>Download events table o render it</h3>
          <form id="log-form">  
            <select id="mail-form" name="log-type" form="log-form">
            <option value="exception" selected>Exception</option>
            <option value="error">Error</option>
            <option value="access">Access</option>
            </select>
            <label class="birthdate">
                Log Date
            <input type="date" name="log-date" id="log-date" value="<?=date('Y-m-d')?>"/>
            </label>
            <input type="submit" name="download" value="download"/>
            <input type="submit" name="show-table" value="show-table"/>
          </form>
        <section class="table-section">
        </section>
    </section>

    <section class="crud-section">
      <h3>CRUD operations on Logs</h3>
      <form id="appointment-list">
        <fieldset>
          <label for="title">Title:</label>
          <input type="text" name="title" id="title" form="appointment-list" required/>
          <label for="description">Description:</label>
          <textarea name="description" id="description" form="appointment-list"></textarea>
          <label for="duedate">Due Date:</label>
          <input type="date" name="duedate" id="duedate" form="appointment-list"/>
          <label for="priority">Priority:</label>
          <select name="priority" id="priority" form="appointment-list">
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
          </select>
          <div class="form-actions">
            <input type="hidden" name="task" id="task" value="task"/>
            <button type="submit">Add/Update</button>
            <button type="clear">Clear</button>
          </div>
        </fieldset>
      </form>
      <div id="tasklist" class="tasklist"></div>
    </section>

    <div id="task-list">
    </div>
  </section>

  <section class="footer-section"></section>
  <div class="modal-container">
  </div>
  <script src="<?= ROOT?>public/assets/bootstrap.assets/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= ROOT?>public/assets/js/common-components/index.js" type="module"></script>
  <script src="<?= ROOT?>public/assets/js/home.js" type="module"></script>
</body>
</html>