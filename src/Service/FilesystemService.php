<?php


namespace App\Service;




use Symfony\Component\DependencyInjection\ContainerInterface;

class FilesystemService
{
    public function __construct(ContainerInterface $container)
    {
        $this->rootDir = $container->getParameter('kernel.project_dir');
    }

    public function getFilesFromDirectory($dir, $extension = false)
    {
        $iterator = new \DirectoryIterator($this->rootDir . $dir);

        $files = [];
        while($iterator->valid()){
            $name = $iterator->getBasename();

            if($name !== '.'
                && $name !== '..'
                && $name !== '.gitignore')
            {
                $files[] = $name;
            }
            $iterator->next();
        }
        if(!$extension){
            $base = [];
            foreach($files as $file){
                $base[] = explode('.',$file);
            }
            $files = [];
            foreach($base as $key=>$item){
                $files[] = $item[0];
            }

        }


        return $files;
    }

}
