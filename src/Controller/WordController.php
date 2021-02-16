<?php

namespace App\Controller;

use App\Entity\Group;
use App\Repository\WordRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class WordController extends AbstractController
{
    /**
     * @Route("/group/{id}/words", name="words_list", methods={"GET"}, requirements={"id"="\d+"})
     * @param Group $group
     * @param WordRepository $repository
     * @return Response
     */
    public function list(Group $group, WordRepository $repository): Response
    {
        if (!$group->getTeachers()->contains($this->getUser())) {
            throw $this->createAccessDeniedException('You are trying to access another teacher\'s group');
        }

        $words = $repository->findAllByGroup($group->getId());
        return $this->json(
            $words,
            Response::HTTP_OK,
            [],
            ["groups" => ["words:list"]]
        );
    }
}
