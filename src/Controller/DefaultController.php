<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function index(): Response
    {
        $root_dir = $this->getParameter('kernel.project_dir');
        $target_dir = $root_dir . '/src/Entity';

        $iterator = new \DirectoryIterator($target_dir);

        $files = [];
        while($iterator->valid()){
            if(
                $iterator->getBasename() !== '.'
                && $iterator->getBasename() !== '..'
                && $iterator->getBasename() !== '.gitignore')
                $files[] = $iterator->getBasename();

            $iterator->next();

        }

        dd($files);

        $user = new User();

        $object = get_class($user);

        //$em =$this->container->get('doctrine')->getEntityManager();

        $entityName = $this->getDoctrine()
            ->getManager()
            ->getMetadataFactory()
            ->getMetadataFor($object);

        return $this->render('default/index.html.twig', [
            'object' => $object,

        ]);
    }
}
