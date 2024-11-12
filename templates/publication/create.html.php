<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="/assets/styles/publication/create.css">
     <?php require_once 'components/head.html'?>
     <title>Publication ~ Création</title>
</head>
<body>
     <?php require_once 'components/admin/header.html.php' ?>

     <div class="containers">
     <div class="container">
          <form enctype="multipart/form-data" class="gap-2 forms-create container d-flex align-items-center justify-content-center flex-column" action="" method="POST">
               <h3 class="mb-5" ><span>Cré</span>ation</h3>
               <?php if (isset($_SESSION)): ?>
                    <?php foreach($_SESSION as $key => $value): ?>
                         <?php if ($key == 'danger' || $key == 'success'):?>
                              <p class="d-flex align-items-center justify-content-center container-sm alert alert-<?=$key?>"><?=$value?></p>
                              <?php unset($_SESSION[$key])?>
                         <?php endif?>
                    <?php endforeach?>
               <?php endif ?>
               <div class="d-flex align-items-center justify-content-center container mb-2">
                    <label style="width:30%" for="" class="fw-bolder">Titre: </label>
                    <input required style="width:70%" type="text" class="form-control" placeholder="Titre..." name="titre">
               </div>
               <div class="d-flex align-items-center justify-content-center container mb-2">
                    <label style="width:30%" for="" class="fw-bolder">Sous-titre: </label>
                    <input required style="width:70%" type="text" class="form-control" placeholder="Sous-titre..." name="subtitle">
               </div>
               <div class="d-flex align-items-center justify-content-center container mb-2">
                    <label style="width:30%" for="" class="fw-bolder">Description: </label>
                    <textarea class="form-control" placeholder="Entrer une description..." style="resize: none;width:70%" name="description" id="" cols="30" rows="6"></textarea>
               </div>
               <div class="d-flex align-items-center justify-content-center container mb-2">
                    <label style="width:30%" for="" class="fw-bolder">Description: </label>
                    <select class="form-select custom-multiple-select" style="width:70%" name="category[]" multiple>
                         <option required selected>Séléctionner une ou plusieurs catégories</option>
                         <?php foreach($categories as $category): ?>
                              <option value="<?=$category->id?>"><?=$category->valeur?></option>
                         <?php endforeach ?>
                    </select>
               </div>
               <div class="d-flex align-items-center justify-content-center container mb-2">
                    <label for="file-upload" class="fw-bolder" style="width:30%;">Image de fond:</label>
                    <div class="file-container" style="width:70%;">
                         <input id="file-upload" type="file" class="custom-file-input" placeholder="Image..." name="image" />
                         <label for="file-upload" class="file-preview" id="file-preview"></label>
                    </div>
               </div>
               <div class="container d-flex align-items-center justify-content-center flex-row">
                    <label style="width:30%;" class="fw-bolder" for="images">Image associée :</label>
                    <input style="width:70%;" type="file" id="images" class="form-control" name="images[]" multiple accept="image/*" onchange="previewImages()">
               </div>
               <input type="hidden" name="token" value="<?=$_SESSION['token']?>">
               <div id="preview"></div>
               <input type="submit" class="btn btn-primary mt-5" value="Créer">
          </form>
     </div>
     </div>

     <script src="/assets/script/publication/create.js"></script>
     <script src="/assets/script/gallery/create.js"></script>

</body>
</html>