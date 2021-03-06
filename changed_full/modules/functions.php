<?php
/**
 * This file is part of OXID eShop Community Edition.
 *
 * OXID eShop Community Edition is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * OXID eShop Community Edition is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with OXID eShop Community Edition.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @link      http://www.oxid-esales.com
 * @copyright (C) OXID eSales AG 2003-2014
 * @version   OXID eShop CE
 */

/**
 * Add custom functions here.
 */

// Premature loading of oxfunctions
require_once dirname( __DIR__ ) . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'oxfunctions.php';

if ( !function_exists( 'module_enabled_count' ) ) {

    /**
     * Get count of shops where module is enabled
     *
     * @param $sModuleId
     *
     * @return int
     */
    function module_enabled_count( $sModuleId )
    {
        $aModuleIds = array_keys( oxRegistry::getConfig()->getConfigParam( 'aModulePaths' ) );
        if ( !in_array( $sModuleId, $aModuleIds ) ) {
            return 0;
        }

        $aConfigs = oxSpecificShopConfig::getAll();
        $iCount   = 0;

        foreach ( $aConfigs as $oConfig ) {
            $aEnabledModules = array_diff( $aModuleIds, $oConfig->getConfigParam( 'aDisabledModules' ) );
            if ( in_array( $sModuleId, $aEnabledModules ) ) {
                $iCount++;
            }
        }

        return $iCount;
    }
}