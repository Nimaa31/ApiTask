<?php
namespace App\Controller;
use App\Entity\Cat;
use App\Repository\CatRepository;
use App\Repository\taskRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class CatController extends AbstractController{
    // je rajoute à la route la méthode associée GET
    #[Route('/cat', name: 'app_cat_index', methods: 'GET')]
        public function index(
        CatRepository $catRepository
    ): Response {
        return $this->json($catRepository->findAll(),200, [], ['groups' => 'cat:readAll']);

    }
    #[Route('/cat', name: 'app_cat_create', methods: 'POST')]
    public function create_cat(
    Request $request,
    userRepository $userRepository,
    catRepository $catRepository,
    SerializerInterface $serializer,
    EntityManagerInterface $em
 ): Response {
 $cat_recup = $request->getContent();
 //décodage du json récupéré
 $data = $serializer->decode($cat_recup, 'json');
 //récupération du user par son id
 //récupération de la catégory par son id
 //création d'une nouvelle tache
 $cat = new cat();
 $cat->setNamecat($data['name_cat']);

 //on fait persister les données
 $em->persist($cat);
 //envoi en BDD
 $em->flush();
 //dump and die de $cat
 dd($cat);
 }
}
