
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v3.8.6">
  <title>Stack Overflow Clone</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/offcanvas/">

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <style>
  .bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }

  @media (min-width: 768px) {
    .bd-placeholder-img-lg {
      font-size: 3.5rem;
    }
  }
</style>
<!-- Custom styles for this template -->
<link href="assets/offcanvas.css" rel="stylesheet">
</head>
<body class="bg-light">
  <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
    <a class="navbar-brand mr-auto mr-lg-0" href="index.php">Stack Overflow Clone</a>
    <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
      <span class="navbar-toggler-icon"></span>
    </button>    
  </nav>

  <main role="main" class="container">
    <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
      <div class="lh-100">
        <h1 class="mb-0 text-white lh-100" style="padding-left: 306px;">We <3 people who code!</h1>
        </div>
      </div>

      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="border-bottom border-gray pb-2 mb-0">Ask Your Question</h6>


        
        
        <?php 
        include 'class/mamuncrud.php';

        $model = new MamunCRUD;
        $id = $_REQUEST['id'];
        $row = $model->edit($id);

        if (isset($_POST['update'])) {
          if (isset($_POST['title']) && isset($_POST['description'])) {

            if (!empty($_POST['title']) && !empty($_POST['description'])) {

              $data['id'] = $id;
              $data['title'] = trim($_POST['title']);
              $data['description'] = trim($_POST['description']);

              $update = $model->update($data);

            } else {

              echo "<script>window.location.href = 'index.php';</script>";
            }
          }
        }

        ?>


        
        
        <form action="" method="post">
          <div class="form-group">
            <input type="text" class="form-control" name="title" placeholder="Title" value="<?php echo $row['title']; ?>">
          </div>
          <div class="form-group">
            <textarea name="description" class="form-control" rows="3" placeholder="Description"><?php echo $row['description']; ?></textarea>
          </div>
          <button type="submit" class="btn btn-primary" name="update">Update</button>
          <a href="index.php" class="btn btn-success">Back</a>
        </form>
      </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
  </html>