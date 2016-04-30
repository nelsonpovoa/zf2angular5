<?php

/**
 * Created by PhpStorm.
 * User: nelson
 * Date: 13-04-2016
 * Time: 14:07
 */

namespace Application\Service;

use Doctrine\ORM\EntityManager;
use Application\Entity\Categoria as CategoriaEntity;

class Categoria
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function insert($nome){
        $categoriaEntity = new CategoriaEntity;
        $categoriaEntity->setNome($nome);

        $this->em->persist($categoriaEntity);
        $this->em->flush();

        return $categoriaEntity;
    }

    public function update(array $data){
        // $categoriaEntity = $this->em->getRepository('Application\Entity\Categoria')
        //     ->find($data{'id'});

        $categoriaEntity = $this->em->getReference('Application\Entity\Categoria', $data['id']);

        $categoriaEntity->setNome($data['nome']);
        $this->em->persist($categoriaEntity);
        $this->em->flush();

        return $categoriaEntity;
    }

    public function delete($id){
        $categoriaEntity = $this->em->getReference('Application\Entity\Categoria', $id);

        $this->em->remove($categoriaEntity);
        $this->em->flush();

        return $id;
    }
}