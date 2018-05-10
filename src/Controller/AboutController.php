<?php

namespace App\Controller;

use App\Utils\DatabaseConnection;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AboutController extends Controller
{
    /**
     * @Route("/about", name="about")
     */
    public function index()
    {
        $connection = new DatabaseConnection();

        $result = $connection->getFeedbackMessages();

        return $this->render('about/index.html.twig', [
            "feedbackMessages" => $result
        ]);
    }
}
