<?php $this->getContent(); ?>

<table width="100%">
    <tr>
        <td align="left">
            <?php echo \Phalcon\Tag::linkTo(array("offers/index", "Go Back")); ?>
        </td>
        <td align="right">
            <?php echo \Phalcon\Tag::linkTo(array("offers/new", "Create offers")); ?>
        </td>
    <tr>
</table>

<table class="browse" align="center">
    <thead>
        <tr>
            <th>Offer</th>
            <th>Offer Of Template</th>
            <th>Date Of Created</th>
            <th>Date Of Expires</th>
        </tr>
    </thead>
    <tbody>
    <?php
        if(isset($page->items)){
            foreach($page->items as $offers){ ?>
        <tr>
            <td><?php echo $offers->offer_id ?></td>
            <td><?php echo $offers->offer_template_id ?></td>
            <td><?php echo $offers->date_created ?></td>
            <td><?php echo $offers->date_expires ?></td>
            <td><?php echo \Phalcon\Tag::linkTo(array("offers/edit/".$offers->offer_id, "Edit")); ?></td>
            <td><?php echo \Phalcon\Tag::linkTo(array("offers/delete/".$offers->offer_id, "Delete")); ?></td>
        </tr>
    <?php }
        } ?>
    </tbody>
    <tbody>
        <tr>
            <td colspan="4" align="right">
                <table align="center">
                    <tr>
                        <td><?php echo \Phalcon\Tag::linkTo("offers/search", "First") ?></td>
                        <td><?php echo \Phalcon\Tag::linkTo("offers/search?page=".$page->before, "Previous") ?></td>
                        <td><?php echo \Phalcon\Tag::linkTo("offers/search?page=".$page->next, "Next") ?></td>
                        <td><?php echo \Phalcon\Tag::linkTo("offers/search?page=".$page->last, "Last") ?></td>
                        <td><?php echo $page->current, "/", $page->total_pages ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    <tbody>
</table>