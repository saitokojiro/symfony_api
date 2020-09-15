<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
        ]
    );

        

        return $this->json($data);
        
    }
}