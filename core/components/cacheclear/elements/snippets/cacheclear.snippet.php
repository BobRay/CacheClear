<?php
/**
 * CacheClear snippet for CacheClear extra
 *
 * Copyright 2012 by Bob Ray <http://bobsguides.com>
 * Created on 12-14-2012
 *
 * CacheClear is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * CacheClear is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * CacheClear; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package cacheclear
 */

/**
 * Description
 * -----------
 * Delete all files in the core/cache directory
 *
 * Variables
 * ---------
 * @var $modx modX
 * @var $scriptProperties array
 *
 * @package cacheclear
 **/

if (!function_exists("rrmdir")) {
    function rrmdir($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir . "/" . $object) == "dir") {
                        rrmdir($dir . "/" . $object);
                    } else {
                        unlink($dir . "/" . $object);
                    }
                }
            }
            reset($objects);
            rmdir($dir);
        }
    }
}

$output = '';
$modx->lexicon->load('cacheclear:default');

$cm = $modx->getCacheManager();
$cacheDir = $cm->getCachePath();

$cacheDir = rtrim($cacheDir, '/\\');

$output .= '<p>' . $modx->lexicon('cc_cache_dir') . ': ' . $cacheDir;
$output .= '<br />';

$files = scandir($cacheDir);


$output .= "<ul>\n";
foreach ($files as $file) {
    if ($file == '.' || $file == '..') {
        continue;
    }
    if (is_dir($cacheDir . '/' . $file)) {
        if ($file == 'logs') {
            continue;
        }
        $output .= "\n<li>" . $modx->lexicon('cc_removing') . ': ' . $file . '</li>';
        rrmdir($cacheDir . '/' . $file);
        if (is_dir($cacheDir . '/' . $file)) {
            $output .= "\n<li>" . $modx->lexicon('cc_failed_to_remove') . ': ' . $file . '</li>';
        }
    } else {
        unlink($cacheDir . '/' . $file);
    }
}

$output .= "\n</p></ul><p>" . $modx->lexicon('cc_finished') . "</p>";


return $output;