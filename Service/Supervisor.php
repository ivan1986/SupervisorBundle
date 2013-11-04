<?php

namespace Ivan1986\SupervisorBundle\Service;


use Symfony\Bundle\TwigBundle\TwigEngine;

class Supervisor {

    /** @var TwigEngine */
    protected $templating;

    public function __construct($templating)
    {
        $this->templating = $templating;
    }



} 