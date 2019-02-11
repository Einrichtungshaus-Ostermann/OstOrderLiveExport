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

use OstOrderCsvWriter\Services\CsvExportService;

class CsvWriter implements OrderExportServiceInterface
{
    /**
     * @var CsvExportService
     */
    private $csvExportService;

    /**
     * ...
     */
    public function __construct()
    {
        $this->csvExportService = Shopware()->Container()->get("ost_order_csv_writer.csv_export_service");
    }

    /**
     * {@inheritdoc}
     */
    public function export( string $number )
    {
        // call the api
        $this->csvExportService->exportOrder($number);
    }
}
