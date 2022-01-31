<h1><?= $velo->getName() ?></h1>
<p><strong>Description : </strong><?= $velo->getDescription() ?></p>
<p>Prix du vélo : <strong><?= $velo->getPrice() ?> €</strong></p>

<img src="image/<?= $velo->getImage() ?>" style="width: 200px;" alt="">

<form action="?type=velo&action=delete" method="post">
    <button class="btn btn-danger" type="submit" name="id" value="<?= $velo->getId() ?>">Supprimer</button>
</form>

<a href="?type=velo&action=edit&id=<?= $velo->getId() ?>" class="btn btn-warning">modifier</a>

<form class="ms-5" action="?type=avi&action=new" method="post">
    <div class="form-group"><input placeholder="Votre nom" type="text" name="author" id=""></div>
    <div class="form-group"><textarea placeholder="Votre avis" type="text" name="content" id=""></textarea></div>
    <div class="form-group"><button type="submit" name='veloId' value="<?= $velo->getId() ?>" class="btn btn-success">Poster</button></div>
</form>

<?php foreach ($avis as $avi) : ?>
    <div class="row bg-success mt-2 mb-2">
        <h3>
            <p><strong><?= $avi->getAuthor() ?></strong></p>
        </h3>
        <p class="ms-5"><?= $avi->getContent() ?></p>

        <form action="?type=avi&action=delete" method="post"><button type="submit" class="btn btn-danger" name="id" value="<?= $avi->getId() ?>">Supprimer</button></form>
        <a href="?type=avi&action=edit&id=<?= $avi->getId() ?>" class="btn btn-warning">Modifier</a>
    </div>
<?php endforeach ?>

<?php if (!$avis) { ?>
    <h2>Soyez le premier à commenter le <?= $velo->getName() ?> !!</h2>
<?php } ?>