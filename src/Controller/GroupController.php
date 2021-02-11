<?php

namespace App\Controller;

use App\Entity\Teacher;
use App\Repository\GroupRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class GroupController extends AbstractController
{
    /**
     * @Route("/groups", name="groups_list", methods={"GET"}))
     * @param GroupRepository $repository
     * @return Response
     */
    public function list(GroupRepository $repository): Response
    {
        $teacher = $this->getUser();
        if (!$teacher instanceof Teacher) {
            throw $this->createAccessDeniedException('User is not a Teacher');
        }

        $groups = $repository->findAllByTeacher($teacher->getId());
        return $this->json(
            $groups,
            Response::HTTP_OK,
            [],
            ["groups" => ["groups:list"]]
        );
    }
}
