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

namespace OstOrderLiveExport\Listeners\Core;

use Enlight_Hook_HookArgs as HookArgs;
use OstOrderLiveExport\Services\OrderExportServiceInterface;

class sOrder
{
    /**
     * ...
     *
     * @var OrderExportServiceInterface
     */
    protected $orderExportService;

    /**
     * ...
     *
     * @param OrderExportServiceInterface $orderExportService
     */
    public function __construct(OrderExportServiceInterface $orderExportService)
    {
        // set params
        $this->orderExportService = $orderExportService;
    }

    /**
     * ...
     *
     * @param HookArgs $arguments
     */
    public function afterSaveOrder(HookArgs $arguments)
    {
        // get the order number
        $number = $arguments->getReturn();

        // active?
        if ( (boolean) Shopware()->Container()->get( "ost_order_live_export.configuration" )['autoExportEnabled'] == false )
            // nope
            return;

        // and send it
        $this->orderExportService->export( $number );
    }
}