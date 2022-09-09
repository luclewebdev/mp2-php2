<form action="?type=message&action=change" method="post">
    <input type="text" name="content" value="<?= $message->getContent() ?>">
    <input type="hidden" name="id" value="<?= $message->getId() ?>">
    <input type="submit">
</form>