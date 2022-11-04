<?php

namespace App\Controller;

use App\Entity\Event;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(): Response
    {
        return $this->render('homepage.html.twig', []);
    }

    /**
     * @Route("/quick_json", name="json")
     */
    public function quick_json(ManagerRegistry $doctrine): JsonResponse
    {
        // from inside a controller
        $repository = $doctrine->getRepository(Event::class);

        // todo: add pagination here!
        $events = $repository->findAll();

        $output = [];
        foreach ($events as $event) {
            $output[$event->getType()][] = $event->getId();
        }

        return $this->json($output);
    }

    /*
     * @Route("/publish", name="publish")
     */
    /*public function publish(HubInterface $hub): Response
    {
        $update = new Update(
            'http://leanatic.dev/api/events/1',
            json_encode(['type' => 1])
        );

        $hub->publish($update);

        return new Response('published!');
    }*/
}
