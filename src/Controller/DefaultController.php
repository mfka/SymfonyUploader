<?php

namespace App\Controller;

use App\Form\Type\ImageUploaderType;
use App\Model\Image;
use App\Service\File\ImageUploader;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @var ImageUploader
     */
    private $imageUploader;

    /**
     * DefaultController constructor.
     * @param ImageUploader $imageUploader
     */
    public function __construct(ImageUploader $imageUploader)
    {
        $this->imageUploader = $imageUploader;
    }

    public function homepage(Request $request)
    {
        $form = $this->createForm(ImageUploaderType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Image $image */
            $image = $form->getData();
            $image = $this->imageUploader->upload($image);
        }
        return $this->render('default/homepage.html.twig', ['form' => $form->createView(), 'image' => isset($image) ? $image : null]);
    }
}