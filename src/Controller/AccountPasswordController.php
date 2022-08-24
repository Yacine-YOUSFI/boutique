<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ChangeMDPType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccountPasswordController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    /**
     * @Route("/compte/password", name="account_password")
     */
    public function index(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $user = $this->getUser(); //utilisateur actuellement connecté
        $form = $this->createForm(ChangeMDPType::class, $user);
        $notification = null;

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {            

            $user->setPassword(
                $encoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            // $this->entityManager->persist($user); //n'est pas utile pour une MàJ
            $this->entityManager->flush();
            $notification = "Votre mot de passe a bien été mis à jour !";
            
        }



        return $this->render('account/password.html.twig', [
            'form' => $form->createView(),
            'notification' =>  $notification
        ]);
    }
}
