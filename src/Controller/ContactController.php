<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ContactType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $address = $data['email'];
            $message = $data['message'];
            $objet = $data['objet'];
            $name = $data['name'];



            $email = (new Email())
                ->from($address)
                ->to('admin@admin.com')
                ->subject($objet)
                ->text($message)
                ->html('<div style="font-family: Arial, sans-serif; background-color: #f1f1f1; padding: 20px;">
                            <div style="background-color: #fff; padding: 20px; border-radius: 5px;">
                                <p style="font-size: 18px;">Objet: ' . $objet . '</p>
                                <p style="font-size: 14px; margin-bottom: 20px; color: #777;">' . $message . '</p>
                                <p style="font-size: 14px; color: #777;">Coordialement,</p>
                                <p style="font-size: 14px; color: #777;">' . $name . '.' .  '</p>
                            </div>
                         </div>');

            $mailer->send($email);
            $this->addFlash("success", "Votre message a bien été envoyé!");

            if ($this->getUser()) {
                $user = $this->getUser();
                $userId = $user->getId();
                return $this->redirectToRoute('app_user_show', ['id' => $userId]);
            }

            return $this->redirectToRoute("app_home");
        }


        return $this->render('contact/index.html.twig', [
            'formulaireContact' => $form,

        ]);
    }
}
