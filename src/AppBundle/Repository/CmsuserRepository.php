<?php
/**
 * Created by PhpStorm.
 * User: dmitr
 * Date: 19.12.2018
 * Time: 20:54
 */

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

class CmsuserRepository extends EntityRepository
{
    public function countUsersInDepartment($departmentId) {
        $em = $this->getEntityManager();
        $qb = $em->createNativeQuery(
            'exec CountUserInDepartment @departmentId = :id',
            new ResultSetMapping()
        );
        $qb->setParameters(
            array(
                'id' => $departmentId
            ));
        $qb->execute();
        $em->flush();
        return $qb->getResult();
    }
}