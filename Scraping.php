<?php
require 'simple_html_dom.php';

$html = file_get_html('https://universitysport.prestosports.com/sports/fball/2021-22/boxscores/20211002_efmq.xml');
$title = $html->find('table', 0);
$image = $html->find('img', 0);

echo $title->plaintext."<br>\n";
echo $image->src;
?>