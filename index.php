<?php
error_reporting(E_ERROR | E_PARSE);

// Assuming you installed from Composer:
require "vendor/autoload.php";

/**
 *
 * @get text between tags
 *
 * @param string $tag The tag name
 *
 * @param string $html The XML or XHTML string
 *
 * @param int $strict Whether to use strict mode
 *
 * @return array
 *
 */
function getTextBetweenTags($tag, $html, $strict=0)
{
    /*** a new dom object ***/
    $dom = new domDocument ;

    /*** load the html into the object ***/
    if($strict==1)
    {
        $dom->loadXML($html);
    }
    else
    {
        $dom->loadHTML($html);
    }

    /*** discard white space ***/
    $dom->preserveWhiteSpace = false;

    /*** the tag by its tag name ***/
    $content = $dom->getElementsByTagname($tag);

    /*** the array to return ***/
    $out = array();
    foreach ($content as $item)
    {
        /*** add node value to the out array ***/
        $out[] = $item->nodeValue;
    }
    /*** return the results ***/
    return $out;
}

$datas = array(
    array(
        'uri' => 'https://symfonycasts.com/tracks/symfony',
        'title' => 'Symfony 5'
    ),
    array(
        'uri' => 'https://symfonycasts.com/tracks/drupal',
        'title' => 'Drupal'
    ),
    array(
        'uri' => 'https://symfonycasts.com/tracks/javascript',
        'title' => 'Javascript'
    ),
    array(
        'uri' => 'https://symfonycasts.com/tracks/symfony4',
        'title' => 'Symfony 4'
    ),
    array(
        'uri' => 'https://symfonycasts.com/tracks/conferences',
        'title' => 'Conferences'
    ),
    array(
        'uri' => 'https://symfonycasts.com/tracks/testing',
        'title' => 'Testing'
    ),
    array(
        'uri' => 'https://symfonycasts.com/tracks/oo',
        'title' => 'POO'
    ),
    array(
        'uri' => 'https://symfonycasts.com/tracks/symfony3',
        'title' => 'Symfony 3'
    ),
    array(
        'uri' => 'https://symfonycasts.com/tracks/rest',
        'title' => 'REST'
    ),
    array(
        'uri' => 'https://symfonycasts.com/tracks/php',
        'title' => 'PHP'
    ),
    array(
        'uri' => 'https://symfonycasts.com/tracks/symfony2',
        'title' => 'Symfony 2'
    ),
    array(
        'uri' => 'https://symfonycasts.com/tracks/extras',
        'title' => 'Dev tools'
    ),
);
//mkdir("tuto/Symfony 5/", 0700);
$tutoRoot = 'tuto';
foreach($datas as $data) {
    $document = new \DiDom\Document($data['uri'], true);
    $bls = $document->find('.track-group-wrapper');
    foreach($bls as $bl){
        $array = array();
        $toto = $bl->find('.course-list-item-title');
        mkdir($tutoRoot.'/'.$data['title'].'/', 0777);
        foreach ($toto as $item) {
            $html = $item->html();
            $url = $item->getAttribute('href');
            $content = getTextBetweenTags('h5', $html);
            $nameFolder = str_replace(':', ' ',$content[0]);
            $array[] = $nameFolder;
            mkdir($tutoRoot.'/'.$data['title'].'/'.$nameFolder. '/', 0777);
        }
    }
}


