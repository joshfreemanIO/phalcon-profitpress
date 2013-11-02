<?php

use \Phalcon\Tag as Tag;

class OffersController extends ControllerBase
{

    public function initialize()
    {
        parent::initialize();
    }

    function indexAction()
    {
        $response = new \Phalcon\Http\Response();
        return $response->redirect("offers/create");

    }

    public function createAction($template_id = 0) {

        Tag::setTitle("Create Offer");

        if (!OfferTemplates::isValid($template_id)) {
            $response = new \Phalcon\Http\Response();
            return $response->redirect("offers/choosetemplate");
        }

    }

    public function choosetemplateAction()
    {
        Tag::setTitle("Choose Your Template");

        $offer_templates = OfferTemplates::find();

        $this->view->setVar('offer_templates', $offer_templates);


    }

    public function createtemplateAction()
    {

        $form = new OfferTemplateForm;

        if ($this->request->isPost()) {

           if( $form->isValid($this->request->getPost())) {
                var_dump($form->getMessages());
            }

        }

        $this->view->form = $form;
    }

    public function generateTemplateForm()
    {

    }



}
