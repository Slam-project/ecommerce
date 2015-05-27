<?php

namespace EasySlam\UserBundle\Listener;

use Doctrine\ORM\Event\OnFlushEventArgs;
use EasySlam\UserBundle\Entity\User;

class UserInscriptionListener
{
    public function onFlush(OnFlushEventArgs $args)
    {
        //$entity = $args->getEntity();
        $em = $args->getEntityManager();

        // peut-être voulez-vous seulement agir sur une entité « Product »
        //if ($entity instanceof User) {
            // faites quelque chose avec l'entité « Product »
        //    $entity->setEnabled(false);
        //}

        //echo "ok";

        $uow = $em->getUnitOfWork();

        foreach ($uow->getScheduledEntityInsertions() as $insertions) {
            foreach ($insertions as $entity) {

                if ($entity instanceof User) {
                    $entity->setEnabled(false);

                    $md = $em->getClassMetadata(get_class($entity));
                    $uow->recomputeSingleEntityChangeSet($md, $entity);
                }
            }

            if ($insertions instanceof User) {
                $insertions->setEnabled(false);

                $md = $em->getClassMetadata(get_class($insertions));
                $uow->recomputeSingleEntityChangeSet($md, $insertions);
            }
        }
    }
}