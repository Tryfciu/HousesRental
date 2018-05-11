<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index()
    {
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }

    /**
     * @Route("/contact/sendFeedback", name="sendFeedback")
     */
    public function sendFeedback(Request $request)
    {
        $data = [];

        if($content = $request->getContent())
        {
            $data[] = json_decode($content, true);
        }

        return new JsonResponse(count($data));
    }
}
