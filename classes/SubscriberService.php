<?php namespace Indikator\News\Classes;

use Indikator\News\Models\Categories;
use Indikator\News\Models\Settings;
use Db;

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
            foreach ($listOfCategoryIds as $categoryId) {
                if (is_numeric($categoryId) && Categories::where(['id' => $categoryId, 'hidden' => 2])->count() == 1 && Db::table('indikator_news_relations')->where(['subscriber_id' => $subscriber->id, 'categories_id' => $categoryId])->count() == 0) {
                    Db::table('indikator_news_relations')->insert([
                        'subscriber_id' => $subscriber->id,
                        'categories_id' => $categoryId
                    ]);
                }
            }
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
