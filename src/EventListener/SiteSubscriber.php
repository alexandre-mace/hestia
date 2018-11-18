<?php

// src/App/EventListener/SiteSubscriber.php
namespace App\EventListener;

use Doctrine\Common\EventSubscriber;
use App\Entity\Site;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use App\Service\RecyclingRateCalculator;
use App\Service\Slugger;
use App\Service\LabelAwarder;
use Symfony\Component\Security\Core\Security;

class SiteSubscriber implements EventSubscriber
{
    private $recyclingRateCalculator;
    private $security;
    private $labelAwarder;

    public function __construct(Security $security, RecyclingRateCalculator $recyclingRateCalculator, Slugger $slugger, labelAwarder $labelAwarder) {
        $this->recyclingRateCalculator = $recyclingRateCalculator;
        $this->slugger = $slugger;
        $this->labelAwarder = $labelAwarder;
        $this->security = $security;
    }
    public function getSubscribedEvents()
    {
        return array(
            'prePersist',
            'preUpdate'
        );
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $this->slugify($args);
        $this->calculateRecyclingRate($args);
        $this->awardLabel($args);
        $this->hydrateAuthor($args);
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $this->slugify($args);
        $this->calculateRecyclingRate($args);
    }

    public function calculateRecyclingRate(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if (!$entity instanceof Site) {
            return;
        }
        $entity->setRecyclingRate($this->recyclingRateCalculator->calculate($entity));
    }
    public function hydrateAuthor(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if (!$entity instanceof Site) {
            return;
        }

        if ($this->security->getUser()) {
            $entity->setManager($this->security->getUser());
        }
    }

    public function slugify(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if (!$entity instanceof Site) {
            return;
        }

        $name = $entity->getName();

        $slug = $this->slugger->slugify($name);
        $entity->setSlug($slug);    
    }

    public function awardLabel(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if (!$entity instanceof Site) {
            return;
        }

        if ($entity->getRecyclingRate()) {
            $this->labelAwarder->award($entity);
        }
    }
}