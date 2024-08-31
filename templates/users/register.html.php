<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <?php require_once 'components/head.html' ?>
     <link rel="stylesheet" href="/assets/styles/user/register.css">
     <link rel="stylesheet" href="/assets/styles/publication/create.css">
     <title>Utilisateurs ~ Création</title>
</head>
<body>
     <?php require_once 'components/admin/header.html.php' ?>
     <div class="registration container">
          <div class="wrapper">
               <h2>Registration</h2>
               <form action="" method="POST" id="form" enctype="multipart/form-data">
                    <div class="row container-fluid">
                         <div class="file-container" style="width:70%;">
                              <input id="file-upload" type="file" class="custom-file-input" placeholder="Image..." name="image" />
                              <label for="file-upload" class="user-preview" id="file-preview"></label>
                         </div>
                    </div>
                    <div class="container-fluid row">
                         <div class="col-md-6 input-box">
                              <input name="nom" class="form-control" type="text" placeholder="Nom..." required>
                         </div>
                         <div class="col-md-6 input-box">
                              <input name="prenom" class="form-control" type="text" placeholder="Prénom...">
                         </div>
                    </div>
                    <div class="row container-fluid">
                         <div class="col-md-6 input-box">
                              <input name="email" class="form-control" type="email" placeholder="Email..." required>
                         </div>
                         <div class="col-md-6 input-box">
                              <input name="passwords" type="password" placeholder="Password..." required>
                         </div>
                    </div>
                    <div class="input-box button">
                         <input type="Submit" value="Créer">
                    </div>
               </form>
          </div>
     </div>

     <script src="/assets/script/publication/create.js"></script>
</body>
</html>