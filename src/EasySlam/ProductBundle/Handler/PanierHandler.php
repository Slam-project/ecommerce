<?php

namespace EasySlam\ProductBundle\Handler;

use Doctrine\ORM\EntityManager;
use EasySlam\ProductBundle\Entity\Commands;
use EasySlam\ProductBundle\Entity\DetailsCommand;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;

class PanierHandler
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * @var \EasySlam\ProductBundle\Entity\Commands
     */
    private $commandsRepository;

    /**
     * @var \Symfony\Component\Security\Core\SecurityContext
     */
    private $securityContext;

    /**
     * Initialise the EntityManager and the repository Product
     *
     * @param EntityManager $em
     * @internal param $ |Doctrine\ORM\EntityManager $em
     */
    public function __construct(EntityManager $em, $securityContext)
    {
        $this->em = $em;
        $this->commandsRepository = $this->em->getRepository('EasySlamProductBundle:Commands');
        $this->securityContext = $securityContext;
    }

    /**
     * @param $id
     * @param $request
     * @return string
     */
    public function addProduct($id, Request $request)
    {
        $qte = $request->request->get('BuyProduct')['Quantite'];

        $user = $this->securityContext->getToken()->getUser();

        $productRepository = $this->em->getRepository('EasySlamProductBundle:Product');
        /** @var \EasySlam\ProductBundle\Entity\Product $product */
        $product = $productRepository->findOneBy(array('id' => $id));

        if($qte > $product->getStock()) {
            return "Stock insuffisant";
        }

        $commandDB = $this->commandsRepository->findBy(array('final' => 0, 'user' => $user->getId()));

        if (count($commandDB) < 1) {
            $command = new Commands();
            $command->setUser($user);
            $command->setEtat(null);
            $command->setFinal(false);
            $command->setEtat($this->em->getRepository('EasySlamProductBundle:EtatCommand')
                ->findOneBy(array('base' => true))
            );
            $this->em->persist($command);

        } else {
            $command = $commandDB[0];
        }


        $detailsCommandRepository = $this->em->getRepository('EasySlamProductBundle:DetailsCommand');
        $detailsCommandDB = $detailsCommandRepository->findOneBy(array('product' => $product, 'command' => $command));

        if (count($detailsCommandDB) == 0 ) {
            $detailsCommand = new DetailsCommand();
            $detailsCommand->setName($product->getName());
            $detailsCommand->setDescription($product->getDescription());

            if ($product->getIsPlanteSemaine() || $product->getIsAccessoireSemaine()) {
                $detailsCommand->setPrice($product->getPrice() / 2);
            } elseif ($product->getIsPlanteMois() || $product->getIsAccessoireMois()) {
                $detailsCommand->setPrice($product->getPrice() / 10 * 8);
            } else {
                $detailsCommand->setPrice($product->getPrice());
            }


            $detailsCommand->setQuantite($qte);
            $detailsCommand->setCommand($command);
            $detailsCommand->setProduct($product);

            $this->em->persist($detailsCommand);
        } else {
            $detailsCommandDB->setQuantite($detailsCommandDB->getQuantite() + $qte);

            $this->em->persist($detailsCommandDB);
        }

        $product->setStock($product->getStock() - $qte);
        $this->em->persist($product);


        $this->em->flush();
    }
}