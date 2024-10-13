<?php

// Mijery we soumis ve le formulaire
if ($_SERVER['REQUEST_METHOD'] == "POST") {
     $nom = $_POST['nom'];
     $prix = $_POST['prix'];
     $category = $_POST['category'];

     $image = $_FILES['image']; // refa misy file le input de $_FILES no ampiasaina angalana azy

     $repertoire = "images/";
     $imageFile = $repertoire . $_FILES['image']['name']; // Maka anle anaran'le fichier

     if (move_uploaded_file($_FILES['image']['tmp_name'], $imageFile)) { // Hafindra ao anatin'le repértoire le fichier hu uploadena
          $sql = "INSERT INTO produit (nom, prix, category, image) VALUES (?,?,?,?)";
          $query = $pdo->prepare($sql);
          $result = $query->execute(['nom' => $nom, 'prix' => $prix, 'category' => $category, 'image' => $imageFile]);
     }
     else {
          echo "KJKJDKFJLKSD";
     }
}