<?php

namespace App\Controller;

use App\Entity\Group;
use App\Entity\Student;
use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/api")
 */
class StudentController extends AbstractController
{
    /**
     * @Route("/groups/{id}/students", name="students_list", methods={"GET"}, requirements={"id"="\d+"})
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

    /**
     * @Route("/students/{id}", name="student_view", methods={"GET"}, requirements={"id"="\d+"})
     * @param Student $student
     * @return Response
     */
    public function view(Student $student): Response
    {
        $group = $student->getGroup();

        if ($group === null) {
            throw $this->createAccessDeniedException('This student has no group');
        }

        if (!$group->getTeachers()->contains($this->getUser())) {
            throw $this->createAccessDeniedException('You are trying to access another teacher\'s group');
        }

        return $this->json(
            $student,
            Response::HTTP_OK,
            [],
            ["groups" => ["student:view"]]
        );
    }

    /**
     * @Route("/students/{id}", name="student_update", methods={"PATCH"}, requirements={"id"="\d+"})
     * @param Request $request
     * @param Student $student
     * @param SerializerInterface $serializer
     * @return Response
     */
    public function update(Request $request, Student $student, SerializerInterface $serializer) : Response
    {
        $group = $student->getGroup();

        if ($group === null) {
            throw $this->createAccessDeniedException('This student has no group');
        }

        if (!$group->getTeachers()->contains($this->getUser())) {
            throw $this->createAccessDeniedException('You are trying to access another teacher\'s group');
        }

        $submittedData = $request->getContent();

        $serializer->deserialize($submittedData, Student::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $student]);

        $this->getDoctrine()->getManager()->flush();

        return $this->json(
            [
                "success" => true,
                "text" => $student->getText(),
            ],
            Response::HTTP_OK
        );
    }
}
