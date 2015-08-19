<?php
/**
 * Resolver for CacheClear extra
 *
 * Copyright 2012-2015 by Bob Ray <http://bobsguides.com>
 * Created on 08-19-2015
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
 * @package cacheclear
 * @subpackage build
 */

/* @var $object xPDOObject */
/* @var $modx modX */

/* @var array $options */

if ($object->xpdo) {
    $modx =& $object->xpdo;
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            /* [[+code]] */
            break;

        case xPDOTransport::ACTION_UNINSTALL:
            $doc = $modx->getOption('modResource', array('alias'=> 'cache-clear'));
            if ($doc) {
                $doc->remove();
            } else {
                $modx->log(MODX_LOG_LEVEL_ERROR, 'Unable to find CacheClear resource - remove manually');
            }
            break;
    }
}

return true;