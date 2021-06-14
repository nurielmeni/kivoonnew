<?php
namespace app\helpers;

use ymaker\social\share\base\AbstractDriver;

class SocialSahreWhatsapp extends AbstractDriver
{
    /**
     * {@inheritdoc}
     */
    protected function processShareData()
    {
        $this->url = static::encodeData($this->url);
    }

    /**
     * {@inheritdoc}
     */
    protected function buildLink()
    {
        return 'https://api.whatsapp.com/send?text={url}';
    }
}