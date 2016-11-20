<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Car;
use AppBundle\Form\CarType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CarController
 * @Route("/car")
 */
class CarController extends Controller{

    /**
     * @Route("/", name="car_index")
     */
    public function indexAction(){
        $repo = $this->getDoctrine()->getRepository('AppBundle:Car');
        $cars = $repo->findAll();
        dump($cars);
        return $this->render("car/index.html.twig", [
            'cars' => $cars,
        ]);
    }

    /**
     * @Route("/details", name="car_details")
     */
    public function detailsAction(Request $request){
        //dump($request->query->get('driver'));
        $repo = $this->getDoctrine()->getRepository("AppBundle:Car");
        //$car = $repo->find(1);
        //$cars = $repo->findByDriver('Mokinys'); //paduoda į CarRepository "Mokinys"
        $cars = $repo->findByDriver($request->query->get('driver')); // 'driver' paima iš address baro
        dump($cars);
        return new Response();

    }



    /**
     * @Route("/add", name="add_car")
     * @param Request $request
     * @return Response
     */
    public function addAction(Request $request){
        //car
        $car = new Car();

        $form = $this->createForm(CarType::class, $car)
            ->add('add', SubmitType::class, ['label' => 'Add Car']);

        //handle forma
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //dump($user);
            $em = $this->getDoctrine()->getManager(); //em duombazės valdymas
            $em->persist($car);
            $em->flush();
            //print_r($car);

            return $this->redirectToRoute("car_index");
        }

        return $this->render("car/add.html.twig", [
            'car' => $car,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{car}", name="edit_car")
     * @param Request $request
     * @param Car $car
     */
    public function editAction(Request $request, Car $car){
        dump($car);
        $form = $this->createForm(CarType::class, $car)
            ->add('edit', SubmitType::class, ['label' => 'Edit Car']);
        //handle forma
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //dump($user);
            $em = $this->getDoctrine()->getManager(); //em duombazės valdymas
            $em->flush();

            return $this->redirectToRoute("car_index");
        }
        return $this->render("car/add.html.twig", [
            'car' => $car,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{car}", name="delete_car")
     * @param Car $car
     */
    public function deleteAction(Request $request, Car $car){
        $form = $this->createFormBuilder()
            ->add('delete', SubmitType::class, ['label' => "Yes"])
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $em = $this->getDoctrine()->getManager(); //em duombazės valdymas
            $em->remove($car);
            $em->flush();

            return $this->redirectToRoute("car_index");
        }
        return $this->render("car/delete.html.twig", [
            'car' => $car,
            'form' => $form->createView(),
        ]);
    }
}
