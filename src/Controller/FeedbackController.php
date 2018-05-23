<?php

namespace App\Controller;

use App\Utils\DatabaseConnection;
use App\Utils\Feedback;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FeedbackController extends Controller
{
    /**
     * @Route("/feedback", name="feedback")
     */
    public function index()
    {
        return $this->render('feedback/index.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }

    /**
     * @Route("/contact/sendFeedback", name="sendFeedback")
     * @Method("POST")
     */
    public function sendFeedback(Request $request)
    {
        $data = [];
        $response = new JsonResponse("There was a problem on our side, please call our team.", 500);
        if ($content = $request->getContent())
        {
            $data[] = json_decode($content);
            if ($data[0]->{"firstName"} !== "" && $data[0]->{"content"} !== "")
            {
                $connection = new DatabaseConnection();
                $connection->addFeedbackMessage(new Feedback($data[0]->{"firstName"}, $data[0]->{"content"}));
                $response = new JsonResponse("Your feedback message is now located in our database.");
            } else {
                $response = new JsonResponse("The is no firstName or content.", 500);
            }
        }
        return $response;
    }
}
