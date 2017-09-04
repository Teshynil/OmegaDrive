<?php

namespace AppBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Doctrine\DBAL\Types\Type;
use AppBundle\Helpers\UTCDateTimeType;

Type::overrideType('datetime', UTCDateTimeType::class);
Type::overrideType('datetimetz', UTCDateTimeType::class);
class AppBundle extends Bundle
{
}
