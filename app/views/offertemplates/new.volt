<?php echo \Phalcon\Tag::form("offertemplates/create") ?>

<table width="100%">
    <tr>
        <td align="left"><?php echo \Phalcon\Tag::linkTo(array("offertemplates", "Go Back")) ?></td>
        <td align="right"><?php echo \Phalcon\Tag::submitButton("Save") ?></td>
    <tr>
</table>

<?php echo $this->getContent(); ?>

<div align="center">
    <h1>Create offer templates</h1>
</div>

    <table align="center">
        <tr>
            <td align="right">
            </td>
            <td align="left">
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
    </table>
<?php echo \Phalcon\Tag::endForm() ?>
