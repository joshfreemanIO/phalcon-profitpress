<?php $this->getContent(); ?>

<table width="100%">
    <tr>
        <td align="left">
            <?php echo \Phalcon\Tag::linkTo(array("offertemplates/index", "Go Back")); ?>
        </td>
        <td align="right">
            <?php echo \Phalcon\Tag::linkTo(array("offertemplates/new", "Create offer templates")); ?>
        </td>
    <tr>
</table>

<table class="browse" align="center">
    <thead>
        <tr>
            <th>Offer Of Template</th>
            <th>Template Of Name</th>
        </tr>
    </thead>
    <tbody>
    <?php
        if(isset($page->items)){
            foreach($page->items as $offertemplates){ ?>
        <tr>
            <td><?php echo $offertemplates->offer_template_id ?></td>
            <td><?php echo $offertemplates->template_name ?></td>
            <td><?php echo \Phalcon\Tag::linkTo(array("offertemplates/edit/".$offertemplates->offer_template_id, "Edit")); ?></td>
            <td><?php echo \Phalcon\Tag::linkTo(array("offertemplates/delete/".$offertemplates->offer_template_id, "Delete")); ?></td>
        </tr>
    <?php }
        } ?>
    </tbody>
    <tbody>
        <tr>
            <td colspan="2" align="right">
                <table align="center">
                    <tr>
                        <td><?php echo \Phalcon\Tag::linkTo("offertemplates/search", "First") ?></td>
                        <td><?php echo \Phalcon\Tag::linkTo("offertemplates/search?page=".$page->before, "Previous") ?></td>
                        <td><?php echo \Phalcon\Tag::linkTo("offertemplates/search?page=".$page->next, "Next") ?></td>
                        <td><?php echo \Phalcon\Tag::linkTo("offertemplates/search?page=".$page->last, "Last") ?></td>
                        <td><?php echo $page->current, "/", $page->total_pages ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    <tbody>
</table>