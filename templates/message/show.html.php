

<h3> <?= $message->getContent(); ?> </h3>
<a href="?type=message&action=change&id=<?= $message->getId() ?>">Editer</a>
<a href="?type=message&action=remove&id=<?= $message->getId() ?>">Supprimer</a>
<a href="index.php">Retour</a>





    <?php foreach ($message->getReponses() as $reponse){?>

        <hr>

        <p><strong><?= $reponse->getContent() ?></strong></p>
        <a href="?type=reponse&action=delete&id=<?=$reponse->getId()?>">Supprimer cette réponse</a>
        <hr>
        <hr>




<?php } ?>
<hr>
<hr>
<hr>
<hr>

<form action="?type=reponse&action=new" method="post">
    <input type="text" name="content" id="">
    <input type="hidden" name="message_id" value="<?= $message->getId() ?>">
    <input type="submit" value="send">
</form>

