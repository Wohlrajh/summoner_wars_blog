<?php

namespace Summoner\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SummonerUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
