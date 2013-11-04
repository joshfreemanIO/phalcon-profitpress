<?php

namespace ProfitPress\Offers\Controllers;

use \Phalcon\Tag as Tag,
    \ProfitPress\Offers\Models\OfferTemplates as OfferTemplates,
    \ProfitPress\Offers\Models\Offers as Offers,
    \ProfitPress\Offers\Forms\OffersForm as OffersForm;


class OffersController extends ControllerBase
{

    public function initialize()
    {
        parent::initialize();
    }

    public function indexAction($offer_id)
    {


    }

    public function viewAction($offer_id)
    {
        $offer = Offers::isValid($offer_id);

        if ( $offer === false) {
            $response = new \Phalcon\Http\Response();
            return $response->redirect("/offers/choosetemplate");
        }

        $this->view->template_id = $offer->getOfferTemplateId;
        $this->view->offer_data = $offer->getOfferData();
    }

    public function createAction($template_id = 0) {

        Tag::setTitle("Create Offer");

        if ( !OfferTemplates::isValid($template_id) ) {
            $response = new \Phalcon\Http\Response();
            return $response->redirect("offers/choosetemplate");
        }

        $form = new OffersForm($template_id);

        if ($this->request->isPost() && $form->isValid($this->request->getPost())  ) {


            $offer = new Offers();

            $date_created = new \DateTime();

            $offer->date_created = $date_created->format("Y-m-d H:i:s");

            $offer->date_expires =  $this->request->getPost('date_expires') . '00:00:00';

            $offer->offer_template_id = $template_id;

            $offer->offer_template_type =  $this->request->getPost('type');

            $offer->serializeAndSetFields($template_id, $this->request->getPost());

            if ($offer->save()) {
                $this->view->success = 'true';
            } else {

                $this->view->success = $offer->getMessages();
            }

        }

        $this->view->template_id = $template_id;
        $this->view->form = $form;

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
