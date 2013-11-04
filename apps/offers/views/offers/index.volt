<?php echo $this->getContent(); ?>
<div align="right">
    <?php echo \Phalcon\Tag::linkTo(array("offers/new", "Create Offers")) ?>
</div>

<div align="center">
    <h1>Search offers</h1>
    <?php echo \Phalcon\Tag::form(array("offers/search")) ?>
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

        <tr>
            <td></td><td><?php echo \Phalcon\Tag::submitButton(array("Search")) ?></td>
        </tr>
    </table>
</form>
</div>