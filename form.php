<?php
if ($_SERVER['REQUEST_METHOD'] === "POST" && !empty($_POST) && $_SERVER['CONTENT_LENGTH'] > 0) {

  if (!isset($_post["action"]) && $_POST["action"] === "send") {
    // Extension file accepted
    $extension_ok = ['jpg', 'png', 'webp'];
    // paht upload
    $updloadDir = "upload/";
    // get the extension of file
    $extension = pathinfo($_FILES["avatar"]['name'], PATHINFO_EXTENSION);
    // get the name of file
    $updloadFile = $updloadDir . basename("avatar." . $extension);
    //$updloadFile=$updloadDir.basename($_FILES["avatar"]['name']); 

    // le poids max géré par PHP par défaul est de 2M
    $maxFileSize = 10000;

    if ($_FILES["avatar"]["size"] / 1024 > $maxFileSize) {
      $errors[] = "I'm sorry but your size of file it's no good !";
    }

    if (!in_array($extension, $extension_ok)) {
      $errors[] = "Juste image ! nobody else !";
    }

    if (empty($errors)) {
      move_uploaded_file($_FILES["avatar"]["tmp_name"], $updloadFile);
    }
  } else if (!isset($_post["action"]) && $_POST["action"] === "delete") {
    if (file_exists("upload/avatar.png")) {
      unlink("upload/avatar.png");
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Upload files</title>
  <!-- CSS only -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="/css/style.css">
</head>

<body>
  <div class="container">

    <h1>Upload File</h1>

    <?php
    if (isset($errors)) {
      echo "<ul class='errors'>";
      foreach ($errors as $value) {
        echo "<li >" . $value . "</li>";
      }
    }
    echo " </ul>";
    ?>

    <div class="accordion" id="accordionExample">
      <div class="card">
        <div class="card-header" id="headingOne">
          <h2 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              Liste personnages
            </button>
          </h2>
        </div>
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
          <div class="card-body">
            <div class="container badge">
              <div class="row badge-head">
                <div class="col col-lg-12">
                  <div class="row">
                    <div class="col col-lg-6"></div>
                    <div class="col col-lg-6 licence">
                      <p>TAXICAB</p>
                      <p>LICENCE</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row badge-body">
                <div class="col col-lg-12">
                  <div class="col col-lg-6"></div>
                  <div class="col col-lg-6 informations">
                    <span>HOMER J. SIMPSON</span>
                    <span>742 EVERGREEN TERRACE</span>
                    <span>SPRINGFIELD, U.S.A.</span>
                    <span>SEXE:M</span>
                    <span>HAIRE: NONE</span>
                    <span class="writer">Homer J Simpson</span>
                  </div>
                </div>
              </div>
              <div class="profile">
                <img src="/upload/avatar.png" alt="" sizes="" srcset="">
              </div>
              <div class="medallion">
                <img src="/img/medallion.png" alt="" sizes="" srcset="">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" id="headingTwo">
          <h2 class="mb-0">
            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              Chargement image profil
            </button>
          </h2>
        </div>
        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
          <div class="card-body">
            <form method="post" enctype="multipart/form-data">
              <label for="imageUpload">Upload an profile image</label>
              <input type="file" name="avatar" id="imageUpload" />
              <div class="row">
                <div class="col col-lg-6">
                  <button name="action" value="send">Envoyer</button>
                </div>
                <div class="col col-lg-6">
                  <button name="action" value="delete">Supprimer</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      console.log("jquery ok !");
    });
  </script>
</body>

</html>