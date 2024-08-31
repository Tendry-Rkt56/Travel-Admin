<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <?php require_once 'components/head.html' ?>
     <link rel="stylesheet" href="/assets/styles/user/profil.css">
     <title><?=$user->nom?> <?=$user->prenom?></title>
</head>
<body>
     <?php require_once 'components/admin/header.html.php' ?>
     <div class="containers">
        <div class="profile-card">
            <div class="profile-content">
                <?php if (isset($user->image) && $user->image != null): ?>
                    <img src="<?=$user->image?>" alt="" class="profile-pic">
                <?php else: ?>
                    <img src="/image/user/default.jpg" alt="" class="profile-pic" style="border:1px solid green">
                <?php endif ?>
                <h2><?=$user->nom?> <?=$user->prenom?></h2>
                <div class="profile-stats">
                    <div>
                        <span>Téléphone</span>
                        <p>(+261) 34 89 889 99</p>
                    </div>
                    <div>
                        <span>Email</span>
                        <p><?=$user->email?></p>
                    </div>
                    <div>
                        <span>Facebook</span>
                        <p>Tendry RKT</p>
                    </div>
                </div>
                <?php if ($user->id == $_SESSION['user']->id): ?>
                    <a href="/users/edit" class="show-more">Editer</a>
                <?php endif ?>
            </div>
        </div>
    </div>
</body>
</html>