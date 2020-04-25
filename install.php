<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=Karla" rel="stylesheet" type="text/css">
  <title>Database Install</title>
  <style>
    body {
      padding: 0;
      margin: 0;
      background-color: #222;
      font-family: 'Karla', 'Trebuchet MS', Arial, sans-serif;
    }

    pre {
      margin: 12px 0;
      color: #eef;
    }

    label {
      margin-bottom: 4px;
      font-weight: 600;
    }

    form {
      padding: 12px 24px 6px 24px;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translateY(-50%) translateX(-50%);
      max-width: 400px;
      color: #222;
      background-color: #eee;
      border-radius: 8px;
    }

    #output {
      margin: 12px;
      padding: 6px;
      color: #eef;
    }

    #output a,
    #output a:visited {
      margin-bottom: 16px;
      text-decoration: none;
      color: #57f;
    }

    #output a:hover {
      color: #8af;
    }
  </style>
</head>

<body>
  <div id="output">
    <?php
    if (isset($_GET['db_init']) && $_GET['db_init']) {
      echo '<a href="install.php">Return to install page</a><br/>';
      require_once('_private/db_init.php');
      die();
    }
    if (isset($_GET['db_drop']) && $_GET['db_drop']) {
      echo '<a href="install.php">Return to install page</a><br/>';
      require_once('_private/db_drop_schema.php');
      die();
    }
    ?>
  </div>


  <form action="install.php" method="get">
    <div class="form-group">
      <label for="db_admin">Database Admin Username</label>
      <input id="db_admin" class="form-control" name="db_admin" type="text" value="root">
    </div>
    <div class="form-group">
      <label for="db_password">Database Password</label>
      <input id="db_password" class="form-control" name="db_password" type="password" value="">
    </div>
    <div class="form-group">
      <label for="path">SQL Script filename</label>
      <input id="path" class="form-control" name="path" type="text" value="db_data.sql">
    </div>
    <div class="form-group">
      <input class="btn btn-dark" name="db_init" type="submit" value="Init Database">
      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirm-drop">Drop Database</button>
    </div>
    <input hidden id="btn-drop-database" name="db_drop" type="submit" value="Drop Database">
  </form>

  <div id="confirm-drop" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Are you sure?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>You are about to delete the user and drop the content of the database schema given in the file at "./_private/env.php".</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" onclick="$('#btn-drop-database').click()">Drop Database</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

</body>

</html>