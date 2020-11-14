<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

use App\Entity\Operation;
use App\Entity\Account;
use App\Entity\User;
use App\Form\ProfilType;

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
     * @Route("/operation/{id}", name="operation", requirements={"id"="\d+"})
     */
    public function operation(int $account_id): Response
    {
        $operationRepository = $this->getDoctrine()->getRepository(Operation::class);
        $operations = $operationRepository->find($account_id);

        // $operationRepository = $this->getDoctrine()->getRepository(Operation::class);
        // $operations = $operationRepository->findAll();

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

    /**
     * @Route("/profil", name="update_profil")
     */
    public function updateProfil(Request $request, ValidatorInterface $validator): Response
    {
        $errors = null;

        $user = $this->getUser();
        $form = $this->createForm(ProfilType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $errors = $validator->validate($user);
            if(count($errors) === 0) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();

                $this->addFlash('success','Votre profil a bien été enregistré');
                return $this->redirectToRoute('bank');
            }
        }

        return $this->render('bank/updateProfil.html.twig', [
            'form' => $form->createView(),
            'errors' => $errors,
        ]);
    }

    /**
     * @Route("/blog", name="blog")
     */
    public function blog(): Response
    {
        return $this->render('bank/blog.html.twig');
    }

}
