<?php


namespace App\Service;




use Symfony\Component\DependencyInjection\ContainerInterface;

class FilesystemService
{
    public function __construct(ContainerInterface $container)
    {
        $this->rootDir = $container->getParameter('kernel.project_dir');
    }

    public function getFilesFromDirectory($dir)
    {
        $iterator = new \DirectoryIterator($this->rootDir . $dir);

        $files = [];
        while($iterator->valid()){
            $name = $iterator->getBasename();

            if($name !== '.' && $name !== '..' && $name !== '.gitignore'){
                $files[] = $name;
            }
            $iterator->next();
        }

        return $files;
    }

}
