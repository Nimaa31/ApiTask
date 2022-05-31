<?php
namespace App\Controller;
use App\Entity\Task;
use App\Repository\CatRepository;
use App\Repository\TaskRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class TaskController extends AbstractController{
    // je rajoute à la route la méthode associée GET
    #[Route('/task', name: 'app_task_index', methods: 'GET')]
        public function index(
        TaskRepository $taskRepository
    ): Response {
        return $this->json($taskRepository->findAll(),200, [], ['groups' => 'task:readAll']);

    }
    #[Route('/task', name: 'app_task_create', methods: 'POST')]
    public function create_task(
    Request $request,
    userRepository $userRepository,
    catRepository $catRepository,
    SerializerInterface $serializer,
    EntityManagerInterface $em
 ): Response {
 $task_recup = $request->getContent();
 //décodage du json récupéré
 $data = $serializer->decode($task_recup, 'json');
 //récupération du user par son id
 $user = $userRepository->find($data['id_user']['id']);
 //récupération de la catégory par son id
 $cat = $catRepository->find($data['id_cat']['id']);
 //création d'une nouvelle tache
 $task = new Task();
 $task->setNameTask($data['name_task']);
 $task->setContentTask($data['content_task']);
 $task->setDateTask(new \DateTimeImmutable);
 $task->setIdUser($user);
 $task->setIdCat($cat);
 //on fait persister les données
 $em->persist($task);
 //envoi en BDD
 $em->flush();
 //dump and die de $task
 dd($task);
 }
}
