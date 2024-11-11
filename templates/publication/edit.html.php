<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <?php require_once 'components/head.html'?>
     <link rel="stylesheet" href="/assets/styles/publication/create.css">
     <title>Publication ~ Création</title>
</head>
<body>
     <?php require_once 'components/admin/header.html.php' ?>

     <div class="containers">
     <div class="container">
          <form enctype="multipart/form-data" class="gap-2 forms-create container d-flex align-items-center justify-content-center flex-column" action="" method="POST">
               <h3 class="mb-5" ><span>Cré</span>ation</h3>
               <div class="d-flex align-items-center justify-content-center container mb-2">
                    <label style="width:30%" for="" class="fw-bolder">Titre: </label>
                    <input value="<?=$publication->titre?>" required style="width:70%" type="text" class="form-control" placeholder="Titre..." name="titre">
               </div>
               <div class="d-flex align-items-center justify-content-center container mb-2">
                    <label style="width:30%" for="" class="fw-bolder">Description: </label>
                    <input value="<?=$publication->description?>" style="width:70%" type="text" class="form-control" placeholder="Description..." name="description">
               </div>
               <div class="d-flex align-items-center justify-content-center container mb-2">
                    <label style="width:30%" for="" class="fw-bolder">Description: </label>
                    <select class="form-select custom-multiple-select" style="width:70%" name="category[]" multiple>
                         <?php foreach($categories as $category): ?>
                              <option <?=in_array($category->id, $selected) ? 'selected' : ''?> value="<?=$category->id?>"><?=$category->valeur?></option>
                         <?php endforeach ?>
                    </select>
               </div>
               <div class="d-flex align-items-center justify-content-center container mb-2">
                    <label for="file-upload" class="fw-bolder" style="width:30%;">Image associée:</label>
                    <div class="file-container" style="width:70%;">
                         <input id="file-upload" type="file" class="custom-file-input" placeholder="Image..." name="image" />
                         <label <?php if (isset($publication->image)): ?>style="background-image: url('<?=$publication->image?>');" <?php endif ?> for="file-upload" class="file-preview" id="file-preview"></label>
                    </div>
               </div>
               <input type="submit" class="btn btn-primary mt-4" value="Modifier">
          </form>
     </div>
     </div>

     <script src="/assets/script/publication/create.js"></script>

</body>
</html>