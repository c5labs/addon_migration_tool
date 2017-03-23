<?php
namespace PortlandLabs\Concrete5\MigrationTool\Publisher\Logger\Formatter\Object;

use HtmlObject\Link;
use PortlandLabs\Concrete5\MigrationTool\Entity\Publisher\Log\Object\LoggableObject;

defined('C5_EXECUTE') or die("Access Denied.");

class JobSetFormatter extends AbstractStandardFormatter
{

    public function getSkippedDescription(LoggableObject $object)
    {
        return t('Job set %s already exists.', $object->getName());
    }

    public function getPublishedDescription(LoggableObject $object)
    {
        return t('Job set %s published.', $object->getName());
    }


}
