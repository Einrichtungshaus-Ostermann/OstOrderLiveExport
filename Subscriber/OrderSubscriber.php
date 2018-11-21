<?php

namespace OstOrderLiveExport\Subscriber;

use Enlight\Event\SubscriberInterface;
use OstCogitoSoapApi\Bundles\OstCogitoSoapApiBundle\CogitoApiService;

class OrderSubscriber implements SubscriberInterface
{
    /**
     * @var CogitoApiService
     */
    private $cogitoApi;



    /**
     * OrderSubscriber constructor.
     * @param CogitoApiService $cogitoApi
     */
    public function __construct(CogitoApiService $cogitoApi)
    {
        $this->cogitoApi = $cogitoApi;
    }



    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Action_PostDispatchSecure_Frontend_Checkout' => 'orderCompleteEvent',
        ];
    }



    public function orderCompleteEvent(\Enlight_Event_EventArgs $args)
    {
        /** @var \Shopware_Controllers_Frontend_Checkout $subject */
        $subject = $args->getSubject();
        $request = $subject->Request();
        $view = $subject->View();
        $enabled = Shopware()->Config()->getByNamespace('OstOrderLiveExport', 'autoExportEnabled');
        $orderNumber = $view->getAssign('sOrderNumber');

        if ($enabled === true && $request->getActionName() === 'finish') {
            $this->cogitoApi->exportOrder($orderNumber);
        }
    }
}