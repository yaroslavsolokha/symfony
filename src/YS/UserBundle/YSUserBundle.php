<?php

namespace YS\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class YSUserBundle extends Bundle
{
  public function getParent()
  {
    return 'FOSUserBundle';
  }
}
