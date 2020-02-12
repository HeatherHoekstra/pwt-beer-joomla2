<?php

use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;

defined('_JEXEC') or die;

$document = Factory::getDocument();
JHtml::_('jquery.framework');


foreach ($this->item as $item) : ?>

    <h1><?php echo $item->name; ?></h1>
    <h4><?php echo $item->tagline ?></h4>

    <hr>
	<?php if ($item->image_url !== 'noimg'): ?>
        <img src="<?php echo $item->image_url ?>" alt="test" width="100">
		<?php echo str_replace('<a href="/', '<a href="' . str_replace(URI::root(true), '', URI::root()), $app); ?>
	<?php endif; ?>
    <hr>

    <p><?php echo $item->description ?></p>

    <p>Average rating: </p>

	<?php

	for ($i = 1; $i <= 5; $i++)
	{
		echo "<span class='icon-star' id='rating-" . $i . "' style='font-size: 24px;'></span>";
	}

	?>

<?php endforeach; ?>

<hr>

<p>Your rating:</p>
<?php
for ($i = 1; $i <= 5; $i++)
{
	echo "<span class='icon-star' id='star-" . $i . "' style='font-size: 24px;'></span>";
}

?>

<input type="hidden" name="rating" value="<?php echo $item->rating; ?>">
<input id="token" type="hidden" name="<?php echo JSession::getFormToken() ?>" value="1"/>

<script>

    window.onload = function () {
        let rating = document.getElementsByName('rating')[0];
        activateStars(rating.value, 'rating');

        // Request to test ajax call while page loads
        let token = jQuery("#token").attr("name");
        jQuery.ajax({
            data: {[token]: "1", task: "ajax", format: "json", rating: rating.value},
            success: function (result, status, xhr) {
                console.log('ajax function successfully called!');
            },
            error: function () {
                console.error('ajax call failed');
            },
        });
    };

    // Defining colors for active and inactive stars
    const activeColor = '#efef21';
    const deactiveColor = '';

    function activateStars(id, className) {
        clearStars(className);
        for (let i = 1; i <= id; i++) {
            let obj = document.getElementById(className + '-' + i).style;
            obj.color = activeColor;
        }
    }

    // Clears rating 'form'
    function clearStars(className) {
        for (let i = 1; i <= 5; i++) {
            document.getElementById(className + '-' + i).style.color = deactiveColor;
        }
    }


    document.addEventListener('click', function (e) {
        if (e.target.id.match('star-')) {

            // define ID
            let idString = e.target.id;
            let id = idString.substr(idString.length - 1);

            activateStars(id, 'star');
        }
    });

    window.onbeforeunload = function () {
        let rating = document.getElementsByName('rating')[0];

        // Request to test ajax call while page loads
        let token = jQuery("#token").attr("name");
        jQuery.ajax({
            data: {[token]: "1", task: "ajax", format: "json", rating: rating.value},
            success: function (result, status, xhr) {
                console.log('ajax function successfully called!');
            },
            error: function () {
                console.error('ajax call failed');
            },
        });
    }

</script>
