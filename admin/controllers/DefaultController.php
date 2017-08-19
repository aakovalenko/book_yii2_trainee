<?php

namespace admin\controllers;

use admin\AdminController;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends AdminController
{

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
