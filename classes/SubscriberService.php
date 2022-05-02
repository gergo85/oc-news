<?php namespace Indikator\News\Classes;

use Indikator\News\Models\Settings;

trait SubscriberService
{
    /**
     * Handles subscriber registration
     * either by registration in the frontend or by creating in the backend
     * 
     * @param $subscriber
     * @param $listOfCategoryIds array of subscribing ids
     * @return void
     */
    public function onSubscriberRegister($subscriber, $listOfCategoryIds)
    {
        // Register category
        if (is_array($listOfCategoryIds)) {
            $subscriber->categories()->sync($listOfCategoryIds);
        }

        if (!$subscriber->isActive()) {
            if (Settings::get('newsletter_double_opt_in', true)) {
                $subscriber->register();
                ConfirmationHandler::sendConfirmationEmailToSubscriber($subscriber);
            }
            else {
                $subscriber->activate();
            }
        }
    }
}
