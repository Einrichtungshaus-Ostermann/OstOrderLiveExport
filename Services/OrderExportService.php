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

class OrderExportService implements OrderExportServiceInterface
{
    /**
     * @var array
     */
    private $configuration;

    /**
     * ...
     *
     * @param array $configuration
     */
    public function __construct(array $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * {@inheritdoc}
     */
    public function export( string $number )
    {
        // switch by adapter
        switch ( $this->configuration['adapter'] )
        {
            case "CogitoSoapApi":
                /* @var $exporter OrderExportServiceInterface */
                $exporter = Shopware()->Container()->get("ost_order_live_export.order_export_service.adapter.cogito_soap_api");
                $exporter->export($number);
                break;
            case "CsvWriter":
                /* @var $exporter OrderExportServiceInterface */
                $exporter = Shopware()->Container()->get("ost_order_live_export.order_export_service.adapter.csv_writer");
                $exporter->export($number);
                break;
            default:
                throw new \Exception("invalid adapter");
        }
    }
}
