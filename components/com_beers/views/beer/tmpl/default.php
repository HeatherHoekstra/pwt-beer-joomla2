<?php

use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;

defined('_JEXEC') or die;

$document = Factory::getDocument();

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
		echo "<button id='rating-" . $i . "'>" . $i . "</button>";
	}

	?>

<?php endforeach; ?>

<hr>

<p>Your rating:</p>
<?php
for ($i = 1; $i <= 5; $i++)
{
	echo "<button id='star-" . $i . "'>" . $i . "</button>";
}

?>

<input type="hidden" name="rating" value="<?php echo $item->rating; ?>">
<input id="token" type="hidden" name="<?php echo JSession::getFormToken() ?>" value="1"/>

<script>

    window.onload = function () {
        let rating = document.getElementsByName('rating')[0];
        activateStars(rating.value, 'rating');

        let data =
            {
                token: document.getElementById('token').getAttribute('name'),
                option: 'com_beers',
                format: 'json',
            };

        fetch('index.php?option=com_beers&rating=' + rating.value, {
            method: 'POST',
            header: {
                'Content-Type': 'application/json',
                'token': document.getElementById('token').getAttribute('name'),
            }
        })
            .then(function (response) {
                return response.text();
            })
            .then(function (text) {
                console.error('error!');
            });
    };

    // Defining colors for active and inactive stars
    const activeColor = 'yellow';
    const deactiveColor = '';

    function activateStars(id, className) {
        clearStars(className);
        for (let i = 1; i <= id; i++) {
            let obj = document.getElementById(className + '-' + i).style;
            obj.backgroundColor = activeColor;
        }
    }

    // Clears rating 'form'
    function clearStars(className) {
        for (let i = 1; i <= 5; i++) {
            document.getElementById(className + '-' + i).style.backgroundColor = deactiveColor;
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
        console.log('user gaat weg :(');

        let rating = document.getElementsByName('rating')[0].value;
        fetch('index.php?option=com_beers&task=beer.ajax&rating=' + rating)
            .then(function (response) {
                return response.text();
            })
            .then(function (text) {
                console.error(text);
            });

    }

</script>
