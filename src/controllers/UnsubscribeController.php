<?php
/**
 * @link      https://www.gp.works
 * @copyright Copyright (c) 2019 Jamie Grisdale
 */

namespace gp\gpxcm\controllers;

use gp\gpxcm\CmLists;

use Craft;
use craft\web\Controller;

/**
 * View and manage your Campaign Monitor subscriber lists in your Craft CMS control panel.
 *
 * @author Mark Reeves, Clearbold, LLC <hello@clearbold.com>
 * @since 1.0.2
 */
class UnsubscribeController extends Controller
{

    // Protected Properties
    // =========================================================================

    protected $allowAnonymous = ['index'];

    /**
     * @returns redirect or JSON
     */
    public function actionIndex()
    {
        $this->requirePostRequest();
        $request = Craft::$app->getRequest();

        // Fetch list id from hidden input
        $listId = $request->getRequiredBodyParam('listId') ? Craft::$app->security->validateData($request->post('listId')) : null;
        $redirect =  $request->getRequiredBodyParam('redirect') ? Craft::$app->security->validateData($request->post('redirect')) : null;
        $email = $request->getParam('email');

        $response = CmLists::getInstance()->campaignmonitor->unsubSubscriber($listId, $email);

        return $request->getBodyParam('redirect') ? $this->redirectToPostedUrl() : $this->asJson($response);
    }

}