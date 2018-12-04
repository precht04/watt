<?php
/**
 * Created by PhpStorm.
 * User: Wilfried Yoro
 * Date: 29/11/2018
 * Time: 10:02
 */
namespace App\Controller;

use App\Entity\Gestionnaire;
use App\Form\GestionnaireType;
use Doctrine\DBAL\Exception\NotNullConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class  GestionnaireController extends AbstractController {

    /**
     * @Route("/gestionnaire/inscription", name="newgestionnaire")
     */
    public function  createGestionnaire(EntityManagerInterface $em,Request $request){
        //Generation du code Gestionnaire
        $racine = "GST";
        $gest =$em->getRepository(Gestionnaire::class)->findAll();
        $nombre_gest = sizeof($gest);

        $nombre_gest += 1;
        $date = date('YmdHis');
        if ($nombre_gest < 10){
            $radical = '00'.$nombre_gest;
        }elseif ($nombre_gest >= 10 && $nombre_gest < 100){
            $radical = "0".$nombre_gest;
        }else{
            $radical = $nombre_gest;
        }
        $codeGest = $racine.''.$date.''.$radical;


        //Creation d'un nouveau gestionnaire
        $newGest = new Gestionnaire();
        //Generation du code Gestionnaire

        $newGest->setCodeGest($codeGest);
        $newGest->setDateInsGest(new \DateTime('now'));

        $form = $this->createForm(GestionnaireType::class, $newGest);
        $form->handleRequest($request);

        //Verification de la validation et l'envoie du formulaire
        if($form->isSubmitted() && $form->isValid()){
            try{
                $em->persist($newGest);
                $em->flush();

                $this->addFlash(
                    'succes',
                    'Votre compte Gestionnaire a été créer avec succès!'
                );
                return $this->redirectToRoute('accueil');
            }catch (NotNullConstraintViolationException $e){
                $this->addFlash(
                    'warning',
                    'Veuillez remplir tous les champs obligatoires !'
                );
            };


        }
        return $this->render('service/signupgestionnaire.html.twig', ['form' => $form->createView()]);
    }
}