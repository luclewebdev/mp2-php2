<form action="?type=message&action=change&id=<?=$message->getId()?>" method="post">
    <input type="text" name="content" value="<?= $message->getContent() ?>">
    <input type="submit">
</form>