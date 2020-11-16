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

class BankController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @Route("/bank", name="bank")
     */
    public function index(): Response
    {
        $user = $this->getUser();

        $accountRepository = $this->getDoctrine()->getRepository(Account::class);
        $accounts = $user->getAccounts();

        dump($accounts);
        
        return $this->render('bank/index.html.twig', [
            'accounts' => $accounts,
        ]);
       
    }

    /**
     * @Route("/operation/{id}", name="operation", requirements={"id"="\d+"})
     */
    public function operation(int $id): Response
    {
        $operationRepository = $this->getDoctrine()->getRepository(Operation::class);
        $operations = $operationRepository->findBy(['account_id' => $id]);

        return $this->render('bank/operation.html.twig', [
            'operations' => $operations
        ]);
    }

    /**
     * @Route("/virement/", name="virement")
     */
    public function virement(Request $request): Response
    {  
        
        $errors = null;

        $user = $this->getUser();
        $accounts = $user->getAccounts();

        if (count($accounts) < 2) {
            $this->addFlash('success','Vous devez nécéssairement avoir plus de deux comptes pour effectuer un virement');
            return $this->redirectToRoute('bank');
        }

        $form = $this->createForm(VirementType::class, null, ['accounts' => $accounts]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
  
            $accountRepository = $this->getDoctrine()->getRepository(Account::class);
            $accountDebit = $accountRepository->findOneBy(['id' => $data['debit']]);
            $accountCredit = $accountRepository->findOneBy(['id' => $data['credit']]);
            $entityManager = $this->getDoctrine()->getManager();

            dump ($data['debit']);
            dump ($data['amount']);
            dump ($data['credit']);

            // generer une op de debit
            $accountDebit->setAmount($accountDebit->getAmount() - $data['amount']);
            // generer une op de credit
            $accountCredit->setAmount($accountCredit->getAmount() + $data['amount']);
            // generer la mise a jour du compte a debiter
            $entityManager->persist($accountDebit);
            // generer la mise a jour du compte a crediter
            $entityManager->persist($accountCredit);
            $entityManager->flush();
            
            
        }

        return $this->render('bank/virement.html.twig', [
            'form' => $form->createView(),
            'errors' => $errors,
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
     * @Route("/new_account", name="new_account")
     */
    public function newAccount(Request $request, ValidatorInterface $validator): Response
    {
        $errors = null;
        $account = new Account();
        $user = $this->getUser();
        $form = $this->createForm(NewAccountType::class, $account);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $account = $form->getData();
            //get the object AccountType
            $account_type_object = $form->get('accountType')->getData();
            //get only the string label of AccountType
            $account_type = $account_type_object->getLabel();
            // connect account_type to new account
            $account->setAccountType($account_type);

            $errors = $validator->validate($account);
            if(count($errors) === 0){

                $entityManager = $this->getDoctrine()->getManager();
                //assigne l'utilisateur connecté
                $account->setUser($user);
                //assigne la date de creation 
                $account->setOpeningDate(new\DateTime('now'));
                $entityManager->persist($account);
                $entityManager->flush();
                // $this->addFlash('success, votre compte à bien été créé');
                return $this->redirectToRoute('index');
            }
        }

        return $this->render('bank/new_account.html.twig', [
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
