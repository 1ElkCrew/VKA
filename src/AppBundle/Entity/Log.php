<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Log
 *
 * @ORM\Table(name="log")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LogRepository")
 */
class Log
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="input1", type="string", length=255, nullable=true)
     */
    private $input1;

    /**
     * @var string
     *
     * @ORM\Column(name="input2", type="string", length=255, nullable=true)
     */
    private $input2;

    /**
     * @var string
     *
     * @ORM\Column(name="output", type="string", length=255, nullable=true)
     */
    private $output;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set input1
     *
     * @param string $input1
     *
     * @return Log
     */
    public function setInput1($input1)
    {
        $this->input1 = $input1;

        return $this;
    }

    /**
     * Get input1
     *
     * @return string
     */
    public function getInput1()
    {
        return $this->input1;
    }

    /**
     * Set input2
     *
     * @param string $input2
     *
     * @return Log
     */
    public function setInput2($input2)
    {
        $this->input2 = $input2;

        return $this;
    }

    /**
     * Get input2
     *
     * @return string
     */
    public function getInput2()
    {
        return $this->input2;
    }

    /**
     * Set output
     *
     * @param string $output
     *
     * @return Log
     */
    public function setOutput($output)
    {
        $this->output = $output;

        return $this;
    }

    /**
     * Get output
     *
     * @return string
     */
    public function getOutput()
    {
        return $this->output;
    }
    public static function create(){
        return new Log();
    }
}

