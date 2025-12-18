<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Page\Asset;
$asset = Asset::getInstance();
$asset->addCss('/local/components/widgets/weather/templates/.default/css/style.css');
$asset->addString('<script src="/local/components/widgets/weather/templates/.default/js/main.js" type="module"></script>');
?>

