<?php

namespace App\Controller;

use App\Entity\Reponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/', name: 'api_')]
class ApiController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager, SerializerInterface $serializer): Response
    {
        $data = $serializer->serialize($entityManager->getRepository(Reponse::class)->findAll(), 'json');

        return new Response(
            $data,
            Response::HTTP_OK,
            ['Content-Type' => 'application/json']
        );
    }

    #[Route('/', name: 'submit', methods: ['POST'])]
    public function submit(EntityManagerInterface $entityManager, Request $request): Response {
        // Récupérer le contenu JSON de la requête
        $content = json_decode($request->getContent(), true);

        // Récupérer les données spécifiques
        $q1 = intval($content['q1']);
        $q2 = intval($content['q2']);
        $q3 = intval($content['q3']);
        $q4 = $content['q4']; // Cette fois, c'est un tableau
        $q5 = intval($content['q5']);
        $q6 = intval($content['q6']);

        // Vérifier que q4 est bien un tableau
        if (!is_array($q4)) {
            return new Response(
                json_encode(["message" => "La réponse à la question 4 doit être un tableau."]),
                Response::HTTP_BAD_REQUEST,
                ['Content-Type' => 'application/json']
            );
        }

        // Validation des autres champs
        if (gettype($q1) != "integer" || gettype($q2) != "integer" || gettype($q3) != "integer" || !is_array($q4) || gettype($q5) != "integer" || gettype($q6) != "integer") {
            return new Response(
                json_encode(["message" => "Des valeurs incorrectes ont été fournies.", "valeurs" => [ "q1" => $q1, "q2" => $q2, "q3" => $q3, "q4" => $q4, "q5" => $q5, "q6" => $q6]]),
                Response::HTTP_BAD_REQUEST,
                ['Content-Type' => 'application/json']
            );
        }

        // Créer une nouvelle réponse
        $reponse = new Reponse();
        $reponse->setQ1($q1);
        $reponse->setQ2($q2);
        $reponse->setQ3($q3);
        $reponse->setQ4($q4); // On passe directement le tableau sans json_encode
        $reponse->setQ5($q5);
        $reponse->setQ6($q6);

        // Sauvegarder dans la base de données
        $entityManager->persist($reponse);
        $entityManager->flush();

        return new Response(
            json_encode(["message" => "Réponse enregistrée avec succès !"]),
            Response::HTTP_OK,
            ['Content-Type' => 'application/json']
        );
    }
}
