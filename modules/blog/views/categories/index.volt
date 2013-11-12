<?php echo $this->getContent(); ?>

<div align="right">
    <?php echo \Phalcon\Tag::linkTo(array("categories/new", "Create Categories", "class" => "btn")) ?>
</div>

<div align="center">

    <h1>Search categories</h1>

    <?php echo \Phalcon\Tag::form(array("categories/search", "autocomplete" => "off")) ?>
    <table align="center">
        <tr>
            <td align="right">
                <label for="id">Id</label>
            </td>
            <td align="left">
                <?php echo \Phalcon\Tag::textField(array("id", "type" => "numeric")) ?>
            </td>
        </tr>
        <tr>
            <td align="right">
                <label for="name">Name</label>
            </td>
            <td align="left">
                <?php echo \Phalcon\Tag::textField(array("name", "size" => 30)) ?>
            </td>
        </tr>
        <tr>
            <td align="right">
                <label for="slug">Slug</label>
            </td>
            <td align="left">
                <?php echo \Phalcon\Tag::textField(array("slug", "size" => 30)) ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td><?php echo \Phalcon\Tag::submitButton(array("Search", "class" => "btn")) ?></td>
        </tr>
    </table>
</form>
</div>