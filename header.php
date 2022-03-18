<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" integrity="sha512-10/jx2EXwxxWqCLX/hHth/vu2KY3jCF70dCQB8TSgNjbCVAC/8vai53GfMDrO2Emgwccf2pJqxct9ehpzG+MTw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Pc Gamers</title>
</head>
<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">PC GAMERS</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="panier.php">Mon panier</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="gammes.php">Nos gammes</a>
          </li>

        </ul>
      </div>


      <?php
      if (!isset($_SESSION['id'])) {
        echo '<li class="nav-item">
          <a class="nav-link" href="connexion.php">Connexion</a>
          <a class="nav-link" href="inscription.php">Inscription</a>
              </li>';
      } else {
        echo '<li class="nav-item">
                                    <a class="nav-link" href="profil.php">Mon compte</a>
                                  </li>
                                  <li class="nav-item">
                                    <form action="index.php" method="post" class="nav-link">
                                        <input type="hidden" name="deconnexion">
                                        <input class="bg-light" type="submit" value="Déconnexion">
                                    </form>
                                  </li>';
      } ?>
      </ul>
    </div>
  </nav>
</header>