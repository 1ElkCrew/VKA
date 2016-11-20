<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller{
    /**
     * @var Request request
     * @Route("/user", name="user")
     * @return  Response
     */
    public function indexAction(Request $request){


        $user = new User();
        $user->setUsername("usr");
        $user->setPassword("pas");

        //fill forma
        $form = $this->createFormBuilder($user)
            ->add('username', TextType::class)
            ->add('password', PasswordType::class)
            ->add('save', SubmitType::class, ['label' => 'Create User'])
            ->getForm();

        //handle forma
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager(); //em duombazės valdymas
            $em->persist($user);
            $em->flush();
            print_r($user);
            //dump($user);
            return new Response();
        }

        //dump($user);
        //eturn new Response();

        //$user->getUsername();
        //$user->getPassword();

        //dump($user);
        //return new Response();
        return $this->render("user/index.html.twig",[
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
