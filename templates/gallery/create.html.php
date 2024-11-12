<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <?php require_once 'components/head.html' ?>
     <link rel="stylesheet" href="/assets/styles/gallery/create.css">
     <title>Gallery ~ ajout</title>
</head>
<body>
     <?php require_once 'components/admin/header.html.php' ?>
     <div class="containers">
          <div class="container">
               <form method="POST" enctype="multipart/form-data" class="d-flex align-items-center justify-content-center flex-column flex-wrap gap-2">
                    <?php if (isset($_SESSION)): ?>
                         <?php foreach($_SESSION as $key => $value): ?>
                              <?php if ($key !== 'user' && $key !== 'token' && $key !== 'panier'):?>
                                   <p class="d-flex align-items-center justify-content-center container-sm alert alert-<?=$key?>"><?=$value?></p>
                                   <?php unset($_SESSION[$key])?>
                              <?php endif?>
                         <?php endforeach?>
                    <?php endif ?>
                    
                    <div class="container-fluid row">
                         <div class="col-sm-6 d-flex align-items-center justify-content-center flex-row">
                              <label class="fw-bolder" for="images">Sélectionnez des images :</label>
                              <input required type="file" id="images" class="form-control" name="image[]" multiple accept="image/*" onchange="previewImages()">
                         </div>
                         <div class="col-md-5 input-box">
                              <select name="destination" id="" class="form-select">
                                   <?php foreach($destinations as $destination): ?>
                                        <option value="<?=$destination->id?>"><?=$destination->titre?></option>
                                   <?php endforeach ?>
                              </select>
                         </div>
                         <button class="col-md-1 btn btn-sm btn-primary" type="submit">Télécharger</button>
                    </div>
                    <input type="hidden" name="token" value="<?=$_SESSION['token']?>">
                    <div id="preview"></div>
               </form>
          </div>
     </div>

     <script src="/assets/script/gallery/create.js"></script>
</body>
</html>