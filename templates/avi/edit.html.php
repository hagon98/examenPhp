<form action="?type=avi&action=edit" method="post">

    <input type="text" name="author" value="<?= $avi->getAuthor() ?>">
    <input type="text" name="content" value="<?= $avi->getContent() ?>">

    <button type="submit" name="veloId" value="<?= $avi->getVeloId() ?>" class="btn btn-success">Enregistrer Les modifications</button>
</form>