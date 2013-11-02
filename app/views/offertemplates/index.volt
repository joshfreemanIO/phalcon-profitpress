<?php echo $this->getContent(); ?>
<div align="right">
    <?php echo \Phalcon\Tag::linkTo(array("offertemplates/new", "Create Offer templates")) ?>
</div>

<div align="center">
    <h1>Search offer templates</h1>
    <?php echo \Phalcon\Tag::form(array("offertemplates/search")) ?>
    <table align="center">
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
                <label for="template_name">Template Of Name</label>
            </td>
            <td align="left">
                <?php echo \Phalcon\Tag::textArea(array("template_name", "cols" => "40", "rows" => "5")) ?>
            </td>
        </tr>

        <tr>
            <td></td><td><?php echo \Phalcon\Tag::submitButton(array("Search")) ?></td>
        </tr>
    </table>
</form>
</div>