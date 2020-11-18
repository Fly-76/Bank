<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

use App\Repository\AccountRepository;
use App\Entity\Operation;
use App\Entity\Account;
use App\Entity\User;
use App\Form\ProfilType;
use App\Form\NewAccountType;
use App\Form\VirementType;

use APP\Repository;
use DateTime;

class BankControllerOffline extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function blog(): Response
    {
        return $this->render('bank/blog.html.twig');
    }

    /**
     * @Route("/statistiques", name="statistics")
     */
    public function statistics(): Response
    {
        return $this->render('bank/statistics.html.twig');
    }

}
