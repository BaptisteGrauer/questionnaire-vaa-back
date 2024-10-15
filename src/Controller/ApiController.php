<?php

namespace App\Controller;

use App\Entity\Reponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api', name: 'api_')]
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

        $q1 = intval($request->query->get('q1'));
        $q2 = intval($request->query->get('q2'));
        $q3 = intval($request->query->get('q3'));
        $q4 = intval($request->query->get('q4'));
        $q5 = intval($request->query->get('q5'));
        $q6 = intval($request->query->get('q6'));

        if (gettype($q1) != "integer" || gettype($q2) != "integer" || gettype($q3) != "integer" || gettype($q4) != "integer" || gettype($q5) != "integer" || gettype($q6) != "integer") {
            return new Response(
                json_encode(["message" => "", "valeurs" => [ "q1" => $q1, "q2" => $q2, "q3" => $q3, "q4" => $q4, "q5" => $q5, "q6" => $q6]]),
                Response::HTTP_BAD_REQUEST,
                ['Content-Type' => 'application/json']
            );
        }
        else {
            $reponse = new Reponse();
            $reponse->setQ1($q1);
            $reponse->setQ2($q2);
            $reponse->setQ3($q3);
            $reponse->setQ4($q4);
            $reponse->setQ5($q5);
            $reponse->setQ6($q6);
            $entityManager->persist($reponse);
            $entityManager->flush();

            return new Response(
                json_encode(["message" => "Réponse enregistrée avec succès !"]),
                Response::HTTP_OK,
                ['Content-Type' => 'application/json']
            );
        }
    }
}
