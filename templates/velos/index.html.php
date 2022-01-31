<a href="?type=velo&action=new" class="btn btn-primary"> Nouveau vélo </a>
<?php foreach ($velos as $velo) { ?>

    <div class="row mt-3 mb-3 bg-warning">

        <h2><?= $velo->getName() ?></h2>
        <img src="image/<?= $velo->getImage() ?>" style="max-width:200px" alt="">
        <h3><strong>description :</strong></h3>
        <p><?= $velo->getDescription() ?></p>
        <p>Prix du vélo : <strong><?= $velo->getPrice() ?> €</strong></p>

        <a href="?type=velo&action=show&id=<?= $velo->getId() ?>" class="btn btn-primary">Voir</a>


    </div>

<?php } ?>