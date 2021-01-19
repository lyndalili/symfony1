<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    private $em;
public function __construct(EntityManagerInterface $em){
    $this->em = $em;
}


    /**
     * @Route("/users", name="user_index")
     */
    public function index(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();
        //dd($users);
        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }
    /**
     * @Route("/users/connected", name="user_connected")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function connected(): Response
    {
        return $this->render('user/connected.html.twig');
    }

    /**
     * @Route("/user/{id}", name="user_edit")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function edit(User $user, Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        //dd($user);
        $formu = $this->createForm(UserType::class, $user);
        $formu->handleRequest($request);
        if ($formu->isSubmitted() && $formu->isValid()) {
            //dd($user);

            if ( $user->getPlainPassword()){
                $hashedPassword = $encoder->encodePassword($user, $user->getPlainPassword());
                $user->setPassword($hashedPassword);

            }
        }
        $this->em->persist($user);
        $this->em->flush();

        return $this->render('user/edit.html.twig', [
            'formu' => $formu->createView(),
        ]);
    }
}
