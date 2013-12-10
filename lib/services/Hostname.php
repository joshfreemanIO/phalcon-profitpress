<?php

namespace ProfitPress\Services;

class Hostname
{

    public $domain_name;

    public $hostname;

    public $protocol = 'https';

    public function __construct()
    {
        $this->setDomainName();
        $this->setHostname();
        $this->setProtocol();
        $this->setBaseUrl();
    }

    protected function setDomainName()
    {
        $SERVER_SOFTWARE = $_SERVER['SERVER_SOFTWARE'];

        if (strpos($SERVER_SOFTWARE, 'nginx') !== false) {
            $this->domain_name = $_SERVER['HTTP_HOST'];
        } else {
            $this->domain_name = $_SERVER['SERVER_NAME'];
        }

        $this->hostname = $this->domain_name;
    }

    protected function setHostname()
    {
        $domain_parts = explode('.', $this->hostname);

        if (count($domain_parts) > 2) {
            $this->type = 'subdomain';
            $this->hostname = $domain_parts[0];
        }
    }

    protected function setProtocol()
    {
        if (empty($_SERVER['HTTPS']))
            $this->protocol = 'http';
    }

    protected function setBaseUrl()
    {
        $this->base_url = $this->protocol . '://' . $this->domain_name;
    }
}