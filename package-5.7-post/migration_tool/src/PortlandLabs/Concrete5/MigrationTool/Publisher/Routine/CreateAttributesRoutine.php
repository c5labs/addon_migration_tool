<?php

namespace PortlandLabs\Concrete5\MigrationTool\Publisher\Routine;

use Concrete\Core\Attribute\Key\Category;
use Concrete\Core\Captcha\Library;
use Concrete\Core\Page\Theme\Theme;
use Concrete\Core\Permission\Key\Key;
use Concrete\Core\Workflow\Type;
use PortlandLabs\Concrete5\MigrationTool\Entity\Import\Batch;
use PortlandLabs\Concrete5\MigrationTool\Entity\Import\AttributeKey\AttributeKey;

defined('C5_EXECUTE') or die("Access Denied.");

class CreateAttributesRoutine implements RoutineInterface
{

    public function execute(Batch $batch)
    {

        $keys = $batch->getObjectCollection('attribute_key');
        /**
         * @var $key AttributeKey
         */
        foreach($keys->getKeys() as $key) {
            if (!$key->getPublisherValidator()->skipItem()) {
                $pkg = null;
                if ($key->getPackage()) {
                    $pkg = \Package::getByHandle($key->getPackage());
                }

                $category = $key->getCategory();
                if (is_object($category)) {
                    $publisher = $category->getPublisher();
                    $o = $publisher->publish($key, $pkg);
                    $typePublisher = $key->getTypePublisher();
                    if (is_object($typePublisher)) {
                        $typePublisher->publish($key, $o);
                    }
                }
            }
        }
    }

}