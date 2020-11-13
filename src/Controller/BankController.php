<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Operation;
use App\Entity\Account;
use APP\Repository;

class BankController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @Route("/bank", name="bank")
     */
    public function index(): Response
    {
        $accountRepository = $this->getDoctrine()->getRepository(Account::class);
        $accounts = $accountRepository->findAll();
        
        return $this->render('bank/index.html.twig', [
            'accounts' => $accounts,
        ]);
       
    }

    /**
     * @Route("/operation", name="operation")
     */
    public function operation(): Response
    {
        $operationRepository = $this->getDoctrine()->getRepository(Operation::class);
        $operations = $operationRepository->findAll();

        return $this->render('bank/operation.html.twig', [
            'operations' => $operations
        ]);
        dump($operations);
    }

    /**
     * @Route("/virement/", name="virement")
     */
    public function virement(): Response
    {
        return $this->render('bank/virement.html.twig', [
            'controller_name' => 'BankController',
        ]);
    }
}
