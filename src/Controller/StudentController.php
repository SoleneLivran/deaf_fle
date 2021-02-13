<?php

namespace App\Controller;

use App\Entity\Group;
use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class StudentController extends AbstractController
{
    /**
     * @Route("/group/{id}/students", name="students_list", methods={"GET"})
     * @param Group $group
     * @param StudentRepository $repository
     * @return Response
     */
    public function list(Group $group, StudentRepository $repository): Response
    {
        if (!$group->getTeachers()->contains($this->getUser())) {
            throw $this->createAccessDeniedException('You are trying to access another teacher\'s group');
        }

        $students = $repository->findAllByGroup($group->getId());
        return $this->json(
            $students,
            Response::HTTP_OK,
            [],
            ["groups" => ["students:list"]]
        );
    }
}
