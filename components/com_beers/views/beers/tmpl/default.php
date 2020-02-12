<?php
echo $this->message;
?>
<table class="table table-striped">
    <thead>
    <tr>
        <th>Name</th>
        <th>Tagline</th>
        <th>Description</th>
        <th>Alcohol percentage</th>
        <th>Rating</th>
    </tr>
    </thead>
    <tbody>
<?php
$error = count($this->items) > 0 ? false : true;

foreach ($this->items as $item):
    $string = "index.php?option=com_beers&task=beer&view=beer&id=" . $item->id;
    ?>
    <tr>
        <td>
            <a href="<?php echo $string; ?>"><?php echo $item->name ?></a>
        </td>
        <td><?php echo $item->tagline ?></td>
        <td><?php echo $item->description ?></td>
        <td><?php echo $item->abv ?></td>
        <!--            <td>--><?php //echo $item->rating
        ?><!-- / 5</td>-->
        <td><?php for ($i = 1; $i <= 5; $i++) : ?>



            <?php endfor; ?></td>
    </tr>
<?php endforeach; ?>
    <td>
		<?php if ($error)
		{
			echo "<strong><h3>No beers were found at this moment...</h3></strong>";
		} ?>
    </td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tbody>
</table>

<input type="hidden" name="task" value=""/>
<input type="hidden" name="boxchecked" value=""/>
<?php echo JHtml::_('form.token'); ?>

