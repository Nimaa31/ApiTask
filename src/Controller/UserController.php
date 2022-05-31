<?php
namespace App\Controller;
use App\Entity\User;
use App\Repository\CatRepository;
use App\Repository\UserRepository;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class UserController extends AbstractController{
    // je rajoute à la route la méthode associée GET
    #[Route('/user', name: 'app_user_index', methods: 'GET')]
        public function index(
        UserRepository $UserRepository
    ): Response {
        return $this->json($UserRepository->findAll(),200, [], ['groups' => 'task:readAll']);

    }
    #[Route('/user', name: 'app_user_create', methods: 'POST')]
    public function create_user(
    Request $request,
    userRepository $userRepository,
    catRepository $catRepository,
    SerializerInterface $serializer,
    EntityManagerInterface $em
 ): Response {
 $user_recup = $request->getContent();
 //décodage du json récupéré
 $data = $serializer->decode($user_recup, 'json');
 //récupération du user par son id
 //récupération de la catégory par son id
 //création d'une nouvelle tache
 $user = new user();
 $user->setNameUser($data['name_user']);
 $user->setFirstNameUser($data['first_name_user']);
 $user->setLoginUser($data['login_user']);
 $user->setMdpUser($data['mdp_user']);
  //on fait persister les données
 $em->persist($user);
 //envoi en BDD
 $em->flush();
 //dump and die de $user
 dd($user);
 }
}
