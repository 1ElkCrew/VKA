<?php
/**
 * Created by PhpStorm.
 * User: briedis
 * Date: 12/11/16
 * Time: 1:33 PM
 */

namespace AppBundle\Service;


use AppBundle\Entity\Log;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class MathService
{
    private $em;
    private $constant;
    private $token;
    public function __construct(EntityManager $em, $constant, TokenStorage $ts)
    {
        $this->em = $em;
        $this->constant = $constant;
        $this->token = $ts;
    }

    public function addNumbers($a, $b){
        //$res = $this->em->getRepository('AppBundle:Car')->findAll();
        $res = $a + $b;
        if ($this->token->getToken() && $this->token->getToken()->getUser()){
            //if user is logged in,
            $res += $this->constant;
        }
        $log = Log::create();
        $log->setInput1($a);
        $log->setInput2($b);
        $log->setOutput($res);
        $this->em->persist($log); //persist pazymi kad reik issaugot duombazeje
        $this->em->flush(); //flush issaugoja pazymetus
        return $res;
    }
}