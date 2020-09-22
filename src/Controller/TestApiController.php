<?php

namespace App\Controller;

use App\Entity\CommentUser;
use App\Entity\Game;
use App\Repository\GameRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class TestApiController extends AbstractController
{
    /**
     * @Route("/test/api", name="test_api")
     */
    public function index()
    {

        $data = array(
            [
                'message' => 'Welcome to your new controller!',
                'path' => 'src/Controller/TestApiController.php',
            ],
            [
                'message' => 'Welcome to your new controller!',
                'path' => 'src/Controller/TestApiController.php',
            ],
        );

        //return $this->json($data);
        $article = file_get_contents(__DIR__ . '/../data/article.json');
        $jsonD = json_decode($article, true);
        return $this->json($jsonD);

    }

    /**
     * @Route("/games/api", name="games_api")
     */

    public function games(GameRepository $articleGm)
    {
        $data = array(
            [
                'message' => 'Welcome to your new controller!',
                'path' => 'src/Controller/TestApiController.php',
            ],
            [
                'message' => 'Welcome to your new controller!',
                'path' => 'src/Controller/TestApiController.php',
            ],
        );

        //return $this->json($data);
        //$article = file_get_contents(__DIR__ . '/../data/article.json');

        $article = $articleGm->findAll();

        $jsonD = json_encode($article);

        return $this->json($article);
    }



    /**
     * @Route("/game/{id}/api", name="game_api")
     */

    public function gameid(GameRepository $articleGm, $id)
    {
        $data = array(
            [
                'message' => 'Welcome to your new controller!',
                'path' => 'src/Controller/TestApiController.php',
            ],
            [
                'message' => 'Welcome to your new controller!',
                'path' => 'src/Controller/TestApiController.php',
            ],
        );

        //return $this->json($data);
        //$article = file_get_contents(__DIR__ . '/../data/article.json');

        $article = $articleGm->findOneBySomeField($id);

        $jsonD = json_encode($article);

        return $this->json($article);
    }

    /**
     * @Route("/game/{id}/comment/api", name="game_comment_api", methods={"POST"})
     */

    public function gameCommentPost(Request $request , GameRepository $gameRepository, EntityManagerInterface $em)
    {
        //dd($gameRepository);
        //dd($request->get('id'));
        $idpage = $request->get('id');
        $gamePage = $gameRepository->find($idpage);
        $jsonRecus =  json_decode($request->getContent());
        //dd(json_decode($jsonRecus));
        $comment = new CommentUser();
        $comment->setUsername($jsonRecus->username);
        $comment->setComment($jsonRecus->comment);
        $comment->setGame($gamePage);


        $em->persist($comment);
        $em->flush();
        dd($comment);

    }


}