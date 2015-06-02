<?php

namespace EasySlam\ProductBundle\Handler;

use Doctrine\ORM\EntityManager;
use EasySlam\ProductBundle\Entity\Commands;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;

class PaymentHandler
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

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
        $this->securityContext = $securityContext;
    }

    /**
     * @param \EasySlam\ProductBundle\Entity\Commands $cmd
     * @param array $paymentForm
     * @return bool
     */
    public function finalCommand(Commands $cmd, $paymentForm)
    {
        $dateLiv = $paymentForm['dateLiv'];
        $dateLiv = new \DateTime($dateLiv['year'] . '-' . $dateLiv['month'] . '-' . $dateLiv['day']);
        $dateNow = new \DateTime("today");
        $dateDiff = date_diff($dateNow, $dateLiv);

        if ($paymentForm['NumCB'] === "00001111222233334444" && $dateDiff->days > 2) {
            $cmd->setAddressLiv($paymentForm['addressLiv']);
            $cmd->setCityLiv($paymentForm['cityLiv']);
            $cmd->setStateLiv($paymentForm['stateLiv']);
            $cmd->setCodePostalLiv($paymentForm['codePostalLiv']);
            $cmd->setDateLiv($dateLiv);
            $cmd->setAddressFac($paymentForm['addressFac']);
            $cmd->setCityFac($paymentForm['cityFac']);
            $cmd->setStateFac($paymentForm['stateFac']);
            $cmd->setCodePostalFac($paymentForm['codePostalFac']);
            $cmd->setDatePayement(new \DateTime());
            $cmd->setFinal(true);
            $this->em->flush();

            return true;
        }

        return false;
    }

    public function getPrixHt($cmd)
    {
        $detailsCommands = $this->em->getRepository("EasySlamProductBundle:DetailsCommand")
            ->findBy(array('command' => $cmd));

        $prixHt = 0;
        foreach ($detailsCommands as $detailsCommand) {
            /** @var \EasySlam\ProductBundle\Entity\DetailsCommand $detailsCommand */
            $prixHt = $prixHt + $detailsCommand->getPrice() * $detailsCommand->getQuantite();
        }

        return $prixHt;
    }
}