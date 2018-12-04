<?php
/**
 * Created by PhpStorm.
 * User: Wilfried Yoro
 * Date: 01/12/2018
 * Time: 08:12
 */
namespace  App\Controller;

use App\Entity\Prestataire;
use App\Form\PrestataireType;
use Doctrine\DBAL\Exception\NotNullConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
// Include Dompdf required namespaces
use Dompdf\Dompdf;
use Dompdf\Options;


class PrestataireController extends AbstractController {
    /**
     * @Route("/prestataire/inscription", name="newprestataire")
     */
    public function createPrestataire(EntityManagerInterface $em, Request $request){

        //Generation du code prestataire
        $racine = "PRS";
        $pres =$em->getRepository(Prestataire::class)->findAll();
        $nombre_pres = sizeof($pres);

        $nombre_pres += 1;
        $date = date('YmdHis');
        if ($nombre_pres < 10){
            $radical = '00'.$nombre_pres;
        }elseif ($nombre_pres >= 10 && $nombre_pres < 100){
            $radical = "0".$nombre_pres;
        }else{
            $radical = $nombre_pres;
        }
        $codePres = $racine.''.$date.''.$radical;
        $session = new Session();
        $session->set('code', $codePres);

        //creation d'un nouveau prestataire
        $newPrestaire = new Prestataire();
        $newPrestaire->setCodePrest($codePres);
        $newPrestaire->setDateInsPrest(new \DateTime('now'));

        $form = $this->createForm(PrestataireType::class, $newPrestaire);
        $form->handleRequest($request);

        //Verification de la validation et l'envoie du formulaire
        if($form->isSubmitted() && $form->isValid()){

            try{
                $em->persist($newPrestaire);
                $em->flush();


                $this->addFlash(
                    'succes',
                    'Votre compte Prestataire a été créer avec succès Vous allez un mail de confirmation!'
                );
                //redirection vers la page d'accueil
                return $this->redirectToRoute('resume');
            }catch (NotNullConstraintViolationException $e){
                $this->addFlash(
                    'warning',
                    'Veuillez remplir tous les champs obligatoires !'
                );
            };


        }
        return $this->render('service/signupprestataire.html.twig', ['form' => $form->createView(),'code'=>$session->get('code')]);
    }

    /**
     * @Route("prestataire/resume", name="resume")
     */
    public function ficheprestataire(EntityManagerInterface $em)
    {
        $session = new Session();
        $dategen = (new \DateTime('now'));
        //recuperation des infos du prestataire recemment
        $prestataire = $em->getRepository(Prestataire::class)->findOneBy([
            'codePrest' => $session->get('code')
        ]);
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('service/resume.html.twig', [
            'codeprest' => $prestataire->getCodePrest(),
            'nomprest' => $prestataire->getNomPrest(),
            'prenomprest' => $prestataire->getPrenomPrest(),
            'telprest' => $prestataire->getTelPrest(),
            'emailprest' => $prestataire->getEmailPrest(),
            'localisation' => $prestataire->getLocalisation(),
            'naturepiece' => $prestataire->getNomPiece(),
            'numeropiece' => $prestataire->getNumPiece(),
            'niveau' => $prestataire->getNiveau(),
            'dateinscription' => $prestataire->getDateInsPrest(),
            'dategen' => $dategen
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("prestataire.pdf", [
            "Attachment" => true
        ]);

        return $this->redirectToRoute('accueil');
    }
}