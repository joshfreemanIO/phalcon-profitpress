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
        //Set a session variable
        $this->session->set("user-name", "Michael");
        $response = new \Phalcon\Http\Response();
        return $response->redirect("offers/create");

    }

    public function createAction($template_id = 0) {

        Tag::setTitle("Create Offer");

        if (!OfferTemplates::isValid($template_id)) {
            $response = new \Phalcon\Http\Response();
            return $response->redirect("offers/choosetemplate");
        }

        $offer_template = OfferTemplates::findFirst("offer_template_id = '$template_id'");

        var_dump($offer_template->getFields());

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

        if (!$this->request->isPost()) {
            return $this->view->form = $form;
        }


        if ( $form->isValid($this->request->getPost())  ) {


            $offer_templates = new OfferTemplates();

            $offer_templates->offer_template_name =  $this->request->getPost('name');
            $offer_templates->offer_template_type =  $this->request->getPost('type');
            $offer_templates->serializeAndSetFields($this->request->getPost('template_options'));

            if ($offer_templates->save()) {
                $this->view->success = 'true';
            } else {

                $this->view->success = $offer_templates->getMessages();
            }

        }

            $this->view->form = $form;
    }

    public function generateTemplateForm()
    {

    }



}
