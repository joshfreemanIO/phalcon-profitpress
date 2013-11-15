<?php

namespace ProfitPress\Offers\Controllers;

use \Phalcon\Tag as Tag,
    \ProfitPress\Offers\Models\OfferTemplates as OfferTemplates,
    \ProfitPress\Offers\Models\Offers as Offers,
    \ProfitPress\Offers\Forms\OffersForm as OffersForm,
    \ProfitPress\Offers\Forms\OfferTemplateForm as OfferTemplateForm,
    \ProfitPress\Permalink\PermalinkModule as PermalinkModule,
    \ProfitPress\Permalink\Controllers\PermalinkController as PermalinkController;


class OffersController extends \ProfitPress\Components\BaseController
{

    public function initialize()
    {
        parent::initialize();
    }

    public function viewAction($id = null)
    {

        $offer = Offers::isValid($id);

        if ( $offer === false) {
            $this->flash->notice("Please choose a valid offer to view");
            $response = new \Phalcon\Http\Response();
            return $response->redirect('offers/viewall');
        }

        $this->view->setLayout('offers');
        $this->view->template_id = $offer->getOfferTemplateId();
        $this->view->offer_data = $offer->getOfferData();

        if ($offer->getOfferTheme())
            $this->view->css = 'css/'.$offer->getOfferTheme();

    }

    public function viewallAction()
    {

        $page = 1;

        if (preg_match('/^\d+$/', $this->dispatcher->getParam(0)) === 1)
            $page = $this->dispatcher->getParam(0);

        //Passing a resultset as data
        $offers = new \Phalcon\Paginator\Adapter\Model(
            array(
                "data"  => Offers::find(),
                "limit" => 4,
                "page"  => $page
            )
        );

        $this->view->offers_paginater = $offers->getPaginate();
    }

    public function createAction($template_id = 0) {

        Tag::setTitle("Create Offer");

        if ( !OfferTemplates::isValid($template_id) ) {

            $this->flash->error("You have chosen an unavailable template, please select from below");
            $response = new \Phalcon\Http\Response();
            return $response->redirect("offers/choosetemplate");
        }

        $form = new OffersForm($template_id);

        if ( $this->request->isPost() && $form->isValid($this->request->getPost()) ) {

            $offer = new Offers();

            $date_created = new \DateTime();

            $offer->date_created = $date_created->format("Y-m-d H:i:s");

            $offer->date_modified = $date_created->format("Y-m-d H:i:s");

            $offer->date_expires = $this->request->getPost('date_expires') . ' 00:00:00';

            $offer->offer_template_id =  $this->request->getPost('template_id');

            $offer->serializeAndSetFields($template_id, $this->request->getPost());

            if ($offer->save()) {
                $this->flash->success("You have created a new offer!");

                $permalinkModule = new PermalinkModule();
                $permalinkModule->registerAutoloaders($this->getDi());

                PermalinkController::createPermalink($this->request->getPost('permalink'),'offers','offers','view',$offer->getOfferId());

                $response = new \Phalcon\Http\Response();
                return $response->redirect("offers/choosetemplate");
            } else {
                $this->flash->error("Please correct your data input below:");
            }
        }

        $this->view->params = $params;
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