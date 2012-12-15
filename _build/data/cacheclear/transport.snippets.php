<?php
/**
 * snippets transport file for CacheClear extra
 *
 * Copyright 2012 by Bob Ray <http://bobsguides.com>
 * Created on 12-14-2012
 *
 * @package cacheclear
 * @subpackage build
 */

if (! function_exists('stripPhpTags')) {
    function stripPhpTags($filename) {
        $o = file_get_contents($filename);
        $o = str_replace('<' . '?' . 'php', '', $o);
        $o = str_replace('?>', '', $o);
        $o = trim($o);
        return $o;
    }
}
/* @var $modx modX */
/* @var $sources array */
/* @var xPDOObject[] $snippets */


$snippets = array();

$snippets[1] = $modx->newObject('modSnippet');
$snippets[1]->fromArray(array(
    'id' => '1',
    'property_preprocess' => '',
    'name' => 'CacheClear',
    'description' => 'Delete all files in the core/cache directory',
    'properties' => array(),
), '', true, true);
$snippets[1]->setContent(file_get_contents($sources['source_core'] . '/elements/snippets/cacheclear.snippet.php'));

return $snippets;
