<?php
/**
 * Created by PhpStorm.
 * User: Wilfried Yoro
 * Date: 25/11/2018
 * Time: 21:01
 */
namespace App\Controller;

use App\Entity\Newsletter;
use App\Form\NewsletterType;
use Doctrine\DBAL\Exception\NotNullConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;


class PrincipalController extends AbstractController {

    /**
     * @Route("/", name="accueil")
     */
    public function accueil(){
        $session = new Session();
        return $this->render('index.html.twig', ['code'=>$session->get('code')]);
    }

    /**
     * @Route("/gestionnaire", name="gestionnaire")
     */
    public function  gestionnaire(){
        return $this->render('service/gestionnaire.html.twig');
    }

    /**
     * @Route("/prestataire", name="prestataire")
     */
    public function  prestataire(){
        return $this->render('service/prestataire.html.twig');
    }

    /**
     * @Route("/locataire", name="locataire")
     */
    public function  locataire(EntityManagerInterface $em, Request $request){
        $newAbonne = new Newsletter();
        $newAbonne->setDateAbonnement(new \DateTime('now'));

        $form = $this->createForm(NewsletterType::class,$newAbonne);
        $form->handleRequest($request);

        //Verification de la validation et l'envoie du formulaire
        if($form->isSubmitted() && $form->isValid()){
            try{
                $em->persist($newAbonne);
                $em->flush();
                $this->addFlash(
                    'succes',
                    'Félicitation ! vous être inscrit à la newsletter'
                );
                //redirection vers la page d'accueil
                return $this->redirectToRoute('locataire');
            }catch (NotNullConstraintViolationException $e){
                $this->addFlash(
                    'warning',
                    'Veuillez entrer votre adresse email !'
                );
            };
        }

        return $this->render('service/locataire.html.twig', ['form' => $form->createView()]);
    }
}