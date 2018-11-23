<?php declare(strict_types=1);

/**
 * Einrichtungshaus Ostermann GmbH & Co. KG - Order Live Export
 *
 * @package   OstOrderLiveExport
 *
 * @author    Tim Windelschmidt <tim.windelschmidt@ostermann.de>
 * @copyright 2018 Einrichtungshaus Ostermann GmbH & Co. KG
 * @license   proprietary
 */

namespace OstOrderLiveExport\Services;

interface OrderExportServiceInterface
{
    /**
     * ...
     *
     * @param string $number
     */
    public function export( string $number );
}
