<?php

use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;

defined('_JEXEC') or die;

$document = Factory::getDocument();
JHtml::_('jquery.framework');

$url = Uri::base() . 'templates/beers/beers.css';
$document->addStyleSheet($url);
?>
<h1><?php echo $this->item->name; ?></h1>
<h4><?php echo $this->item->tagline ?></h4>

<hr>
<?php if ($this->item->image_url !== 'noimg'): ?>
    <img src="<?php echo $this->item->image_url ?>" alt="<?php echo $this->item->name ?>" width="100">
	<?php echo str_replace('<a href="/', '<a href="' . str_replace(URI::root(true), '', URI::root()), $app); ?>
<?php endif; ?>
<hr>

<p><?php echo $this->item->description ?></p>

<p>Average rating: </p>

<?php
for ($i = 1; $i <= 5; $i++)
{
	echo "<span class='icon-star' id='rating-" . $i . "'></span>";
}
?>

<hr>

<p>Your rating:</p>
<?php
for ($i = 1; $i <= 5; $i++)
{
	echo "<span class='icon-star' id='star-" . $i . "'></span>";
}
?>

<input type="hidden" name="rating" value="<?php echo $this->item->rating; ?>">
<input id="token" type="hidden" name="<?php echo JSession::getFormToken() ?>" value="1"/>

<script>
    const activeColor = '#efef21';
    const beerID = new URL(document.URL).searchParams.get('id');
    let storageLocation = 'rating-' + beerID;

    window.onload = function () {
        activateStars(getRating(), 'rating');
        if (JSON.parse(localStorage.getItem(storageLocation)) !== null) {
            activateStars(JSON.parse(localStorage.getItem(storageLocation)).rating, 'star');
        }
    };

    function getRating() {
        return document.getElementsByName('rating')[0].value;
    }

    function insertLocalStorage(id) {
        let date = new Date;
        localStorage.setItem(storageLocation, JSON.stringify({'timestamp': date.getTime(), 'rating': id}));
    }

    function checkLocalStorage() {
        let storage = JSON.parse(localStorage.getItem(storageLocation));
        if (storage === null) {
            return true;
        }

        let date = new Date;
        return storage.timestamp === null ? true : (((date.getTime() / 1000) - (storage.timestamp / 1000)) > 5);
    }

    function ajaxCall(id) {
        if (checkLocalStorage()) {

            let token = jQuery("#token").attr("name");
            jQuery.ajax({
                data: {[token]: "1", task: "ajax", format: "json", rating: id},
                success: function (result, status, xhr) {
                    console.log('ajax function successfully called!');
                    insertLocalStorage(id);
                    activateStars(result.data, 'rating');
                },
                error: function () {
                    console.error('ajax call failed');
                },
            });
        }
    }

    function activateStars(id, className) {
        clearStars(className);
        for (let i = 1; i <= id; i++) {
            let obj = document.getElementById(className + '-' + i).style;
            obj.color = activeColor;
        }
    }

    function clearStars(className) {
        for (let i = 1; i <= 5; i++) {
            document.getElementById(className + '-' + i).style.color = '';
        }
    }

    document.addEventListener('click', function (e) {
        if (e.target.id.match('star-')) {

            let idString = e.target.id;
            let id = idString.substr(idString.length - 1);

            activateStars(id, 'star');
            ajaxCall(id);
        }
    });
</script>
