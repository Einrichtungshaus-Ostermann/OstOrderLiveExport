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

use OstCogitoSoapApi\Bundles\OstCogitoSoapApiBundle\CogitoApiService;

class OrderExportService implements OrderExportServiceInterface
{
    /**
     * @var CogitoApiService
     */
    private $cogitoApi;

    /**
     * ...
     *
     * @param CogitoApiService $cogitoApi
     */
    public function __construct(CogitoApiService $cogitoApi)
    {
        $this->cogitoApi = $cogitoApi;
    }

    /**
     * {@inheritdoc}
     */
    public function export( string $number )
    {
        // call the api
        $this->cogitoApi->exportOrder($number);
    }
}
