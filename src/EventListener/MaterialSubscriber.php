<?php

namespace App\EventListener;

use Doctrine\Common\EventSubscriber;
use Symfony\Component\Security\Core\Security;
use App\Entity\Material;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use App\Service\Slugger;

class MaterialSubscriber implements EventSubscriber
{
    private $slugger;

    public function __construct(Slugger $slugger) 
    {
        $this->slugger = $slugger;
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
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $this->slugify($args);
    }

    public function slugify(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        // upload only works for Material entities
        if (!$entity instanceof Material) {
            return;
        }

        $name = $entity->getName();

        $slug = $this->slugger->slugify($name);
        $entity->setSlug($slug);    
    }
}