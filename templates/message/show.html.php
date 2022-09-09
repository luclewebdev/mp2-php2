

<h3> <?= $message->getContent(); ?> </h3>
<a href="?type=message&action=change&id=<?= $message->getId() ?>">Editer</a>
<a href="?type=message&action=remove&id=<?= $message->getId() ?>">Supprimer</a>
<a href="index.php">Retour</a>