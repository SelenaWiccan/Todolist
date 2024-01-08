<?php

namespace App\Controller;

use App\Entity\Todo;
use App\Form\TodoType;
use App\Repository\TodoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/todo")
 */
class TodoController extends AbstractController
{
    /**
   * @Route("/", name="app_todo_index", methods={"GET"})
     */
    public function index(Request $request, TodoRepository $todoRepository): Response //(TodoRepository $todoRepository)
    {//}
//$todos = $todoRepository->findBy($criteria);

        $orderBy = $request->query->get('orderby') ?? 'id';
        $order = $request->query->get('order', 'ASC');
        $n = $order == 'ASC' ? 'DESC' : 'ASC';


        return $this->render('todo/index.html.twig', [
            'todos' => $todoRepository->findAllOrdered($orderBy, $order),
            'order' => $n,
//            findBy([],[ //findAll(), -> find AllOrdered
//                'name'=>'ASC'
//            ])
        ]);

    }

//test

    /**
     * @Route("/new", name="app_todo_new", methods={"GET", "POST"})
     */
    public function new(Request $request, TodoRepository $todoRepository): Response
    {
        $todo = new Todo();
        $form = $this->createForm(TodoType::class, $todo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $todoRepository->add($todo, true);

            return $this->redirectToRoute('app_todo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('todo/new.html.twig', [
            'todo' => $todo,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_todo_show", methods={"GET"})
     */
    public function show(Todo $todo): Response
    {
        dump($todo);
        return $this->render('todo/show.html.twig', [
            'todo' => $todo,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_todo_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Todo $todo, TodoRepository $todoRepository): Response
    {
        $form = $this->createForm(TodoType::class, $todo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $todoRepository->add($todo, true);

            return $this->redirectToRoute('app_todo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('todo/edit.html.twig', [
            'todo' => $todo,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_todo_delete", methods={"POST"})
     */
    public function delete(Request $request, Todo $todo, TodoRepository $todoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $todo->getId(), $request->request->get('_token'))) {
            $todoRepository->remove($todo, true);
        }

        return $this->redirectToRoute('app_todo_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/{id}/updatestatus", name="app_todo_done", methods={"GET", "POST"})
     */
    public function done( Todo $todo, EntityManagerInterface $em)
    {
        $todo->setDone('1');
        $em->persist($todo);
        $em->flush();

        return $this->json(['message'=> 'success']);
    }

    /**
     * @Route("/{id}/updatestatus2", name="app_todo_todo", methods={"GET", "POST"})
     */
    public function todo( Todo $todo, EntityManagerInterface $em)
    {
        $todo->setDone('0');
        $em->persist($todo);
        $em->flush();

        return $this->json(['message'=> 'success2']);
    }



    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i <= 50; $i++) {
            $article = new Todo();
            $article->setName($this->faker->sentence(4))
                ->setDescription($this->faker->paragraph)
                ->setDone(rand(0,1)>0.5);
            $manager->persist($article);
        }
        $manager->flush();
    }

}