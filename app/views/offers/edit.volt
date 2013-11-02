<?php echo $this->getContent(); ?>

<?php echo \Phalcon\Tag::form("offers/save") ?>

<table width="100%">
    <tr>
        <td align="left"><?php echo \Phalcon\Tag::linkTo(array("offers", "Back")) ?></td>
        <td align="right"><?php echo \Phalcon\Tag::submitButton(array("Save")) ?></td>
    <tr>
</table>

<div align="center">
    <h1>Edit offers</h1>
</div>

    <table align="center">
        <tr>
            <td align="right">
                <label for="offer_id">Offer</label>
            </td>
            <td align="left">
            <?php echo \Phalcon\Tag::textField(array("offer_id", "type" => "numeric")) ?>
            </td>
        </tr>
        <tr>
            <td align="right">
                <label for="offer_template_id">Offer Of Template</label>
            </td>
            <td align="left">
            <?php echo \Phalcon\Tag::textField(array("offer_template_id", "type" => "numeric")) ?>
            </td>
        </tr>
        <tr>
            <td align="right">
                <label for="date_created">Date Of Created</label>
            </td>
            <td align="left">
            <?php echo \Phalcon\Tag::textField(array("date_created", "size" => 30)) ?>
            </td>
        </tr>
        <tr>
            <td align="right">
                <label for="date_expires">Date Of Expires</label>
            </td>
            <td align="left">
            <?php echo \Phalcon\Tag::textField(array("date_expires", "size" => 30)) ?>
            </td>
        </tr>
    </table>
    <?php echo \Phalcon\Tag::endForm() ?>
