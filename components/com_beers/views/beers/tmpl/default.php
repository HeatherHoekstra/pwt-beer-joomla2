<?php

use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;

echo $this->message;
$error = count($this->items) > 0 ? false : true;

$document = JFactory::getDocument();
$url      = Uri::base() . 'templates/beers/beers.css';
$document->addStyleSheet($url);
?>

<?php if (!$error) : ?>
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Tagline</th>
            <th>Description</th>
            <th>Alcohol</th>
            <th>Rating</th>
        </tr>
        </thead>
        <tbody>
		<?php
		foreach ($this->items as $item): ?>
            <tr>
                <td>
                    <a href="<?php echo Route::_('index.php?view=beer&id=' . $item->id); ?>"><?php echo $item->name ?></a>
                </td>
                <td><?php echo $item->tagline ?></td>
                <td><?php echo $item->description ?></td>
                <td><?php echo $item->abv ?>%</td>

                <td class='stars' data-rating="<?php echo $item->rating ?>">
					<?php for ($i = 1; $i <= $item->rating; $i++) : ?>
                        <span class='icon-star' id='rating- <?php echo $i; ?>' style='color: #efef21'></span>
					<?php endfor; ?>

					<?php for ($i = 1; $i <= (5 - $item->rating); $i++) : ?>
                        <span class='icon-star' id='rating- <?php echo $i; ?>'></span>
					<?php endfor; ?>
                </td>
            </tr>
		<?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
<?php if ($error)
{
	echo "<strong><h3>No beers were found at this moment...</h3></strong>";
} ?>
<?php echo JHtml::_('form.token'); ?>
