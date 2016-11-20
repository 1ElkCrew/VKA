<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Car;
use AppBundle\Entity\CarModel;
use AppBundle\Form\CarType;
use AppBundle\Form\ModelsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ModelsController
 * @Route("/models")
 */
class ModelsController extends Controller{

    /**
     * @Route("/", name="models")
     */
    public function indexAction(){
        $repo = $this->getDoctrine()->getRepository('AppBundle:CarModel');
        $cars = $repo->findAll();
        //dump($cars);
        $form = $this->createForm(ModelsType::class);
        return $this->render("car/models.html.twig", [
            'models' => $cars,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit_models/{modelsType}", name="edit_models")
     * @param Request $request
     * @param ModelsType $modelsType
     */
    public function editAction(Request $request, CarModel $modelsType){
        $form = $this->createForm(ModelsType::class, $modelsType)
            ->add('edit', SubmitType::class, ['label' => 'Edit Model']);
        $form->handleRequest($request);
        if($form->isValid() && $form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("models");
        }

        return $this->render("car/editModels.html.twig", [
            'model' => $modelsType,
            'form' => $form->createView(),
        ]);
    }
}
