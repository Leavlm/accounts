<?php
require "includes/_head.php";
require "includes/_database.php";
require "includes/_functions.php";

$id = $_GET['id'];

if (!is_numeric($id) || intval($id) <= 0) {
    exit("ID invalide");
}

$query = $dbCo->prepare(
    "SELECT `name`, `amount`, `date_transaction`, `id_transaction`, `id_category`
    FROM `transaction`
    WHERE `id_transaction` = :id"
);

$query->bindValue(':id', $id, PDO::PARAM_INT);
$query->execute();
$transaction = $query->fetch();




?>

<div class="container-fluid">
    <header class="row flex-wrap justify-content-between align-items-center p-3 mb-4 border-bottom">
        <a href="index.php" class="col-1">
            <i class="bi bi-piggy-bank-fill text-primary fs-1"></i>
        </a>
        <nav class="col-11 col-md-7">
            <ul class="nav">
                <li class="nav-item">
                    <a href="index.php" class="nav-link link-secondary" aria-current="page">Opérations</a>
                </li>
                <li class="nav-item">
                    <a href="summary.html" class="nav-link link-body-emphasis">Synthèses</a>
                </li>
                <li class="nav-item">
                    <a href="categories.html" class="nav-link link-body-emphasis">Catégories</a>
                </li>
                <li class="nav-item">
                    <a href="import.html" class="nav-link link-body-emphasis">Importer</a>
                </li>
            </ul>
        </nav>
        <form action="" class="col-12 col-md-4" role="search">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Rechercher..." aria-describedby="button-search">
                <button class="btn btn-primary" type="submit" id="button-search">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
    </header>
</div>
<?= displayMsg($msg) ?>

<div class="container">
    <section class="card mb-4 rounded-3 shadow-sm">
        <div class="card-header py-3">
            <h1 class="my-0 fw-normal fs-4">Modifier une opération</h1>
        </div>
        <div class="card-body">
            <form action="actionmodify.php?id=<?=intval($id)?>" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Nom de l'opération *</label>
                    <input type="text" class="form-control" name="name" id="name" value="<?= $transaction['name'] ?>">
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Date *</label>
                    <input type="date" class="form-control" name="date" id="date" value="<?= $transaction['date_transaction'] ?>">
                </div>
                <div class="mb-3">
                    <label for="amount" class="form-label">Montant *</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="amount" id="amount" value="<?= $transaction['amount'] ?>">
                        <span class="input-group-text">€</span>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Catégorie</label>
                    <select class="form-select" name="category" id="category">
                        <option value="" <?= ($transaction['id_category'] == '') ? 'selected' : '' ?>>Aucune catégorie</option>
                        <option value="1" <?= ($transaction['id_category'] == 1) ? 'selected' : '' ?>>Habitation</option>
                        <option value="2" <?= ($transaction['id_category'] == 2) ? 'selected' : '' ?>>Travail</option>
                        <option value="3" <?= ($transaction['id_category'] == 3) ? 'selected' : '' ?>>Cadeau</option>
                        <option value="4" <?= ($transaction['id_category'] == 4) ? 'selected' : '' ?>>Numérique</option>
                        <option value="5" <?= ($transaction['id_category'] == 5) ? 'selected' : '' ?>>Alimentation</option>
                        <option value="6" <?= ($transaction['id_category'] == 6) ? 'selected' : '' ?>>Voyage</option>
                        <option value="7" <?= ($transaction['id_category'] == 7) ? 'selected' : '' ?>>Loisir</option>
                        <option value="7" <?= ($transaction['id_category'] == 8) ? 'selected' : '' ?>>Voiture</option>
                        <option value="7" <?= ($transaction['id_category'] == 9) ? 'selected' : '' ?>>Santé</option>
                    </select>
                    
                </div>
                <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg">Modifier</button>
                </div>
            </form>
        </div>
    </section>
</div>
<div class="position-fixed bottom-0 end-0 m-3">
    <a href="add.html" class="btn btn-primary btn-lg rounded-circle">
        <i class="bi bi-plus fs-1"></i>
    </a>
</div>

<footer class="py-3 mt-4 border-top">
    <p class="text-center text-body-secondary">© 2023 Mes comptes</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>