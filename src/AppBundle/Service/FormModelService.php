<?php
/**
 * Created by PhpStorm.
 * User: briedis
 * Date: 12/11/16
 * Time: 3:13 PM
 */

namespace AppBundle\Service;


use AppBundle\Form\ModelsType;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Response;

class FormModelService
{
    private $em;
    private $ff;
    private $twig;
    public function __construct(EntityManager $em, FormFactory $ff, \Twig_Environment $twig){
        $this->em = $em;
        $this->ff = $ff;
        $this->twig = $twig;
    }

    public function getCarModels(){
        $models = $this->em->getRepository('AppBundle:CarModel')->findAll();
        $form = $this->ff->create(ModelsType::class, $models, []);
        $response = new Response();
        return $response->setContent($this->twig->render("car/models.html.twig", [
                'models' => $models,
                'form' => $form->createView(),
            ]
        ));
    }

}