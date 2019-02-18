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

namespace OstOrderLiveExport\Services\Adapter;

use OstCogitoSoapApi\Bundles\OstCogitoSoapApiBundle\CogitoApiService;

class CogitoSoapApi implements OrderExportServiceInterface
{
    /**
     * @var CogitoApiService
     */
    private $cogitoApi;

    /**
     * ...
     */
    public function __construct()
    {
        $this->cogitoApi = Shopware()->Container()->get("ost_cogito_soap_api.cogito_api_service");
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
