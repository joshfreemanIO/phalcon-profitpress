<?php

/**
 * Contains the Hostname class
 *
 * @category  ProfitPress
 * @package   ProfitPress\Services
 * @author    Josh Freeman <jdfreeman@satx.rr.com>
 * @copyright 2013 Help Yourself Today LLC
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   1.0.0
 * @link      http://documentation.profitpress.com
 * @since     File available since Release 1.0.0
 */

namespace ProfitPress\Services;

/**
 * The Hostname class
 *
 * This class is designed to be a Phalcon service that parses the $_SERVER
 * global variable and sets properties for the application's later use.
 *
 * <code>
 * $di->setShared(new \ProfitPress\Services\Hostname)
 * </code>
 * 
 * @category ProfitPress
 * @package  ProfitPress\Services
 * @author   Josh Freeman <jdfreeman@satx.rr.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version  1.0.0
 * @link     http://developer.profitpress.com
 * @since    1.0.0
 */
class Hostname
{

    /**
     * The domain name requested by the HTTP header
     *
     * alpha.example.com, bravo.example.org, etc.
     *
     * @var string
     * @see Hostname::setDomainName() protected method setDomainName
     */
    public $domain_name;

    /**
     * Holds a the root URL with appropriate protocol
     *
     * http://example.com, https://example.org, etc.
     *
     * @var string
     * @see Hostname::setBaseUrl() protected method setBaseUrl
     */
    public $base_url;

    /**
     * The hostname of the server; typically just a protocol-less domain
     *
     * If the requested domain is a subdomain of primary domain,
     * the hostname is simply the subdomain; e.g., with a primary domain of
     * example.com, alpha.example.com returns alpha and bravo.example.org will
     * return bravo.
     *
     * @var string
     * @see Hostname::setHostname() protected method setHostname
     */
    public $hostname;

    /**
     * The URI scheme describing the HTTP protocol and its security status
     *
     * http or https
     *
     * @var string
     * @see Hostname::setProtocol() protected method setProtocol
     */
    public $protocol = 'https';

    /**
     * Class constructor calls property-setting methods.
     *
     */
    public function __construct()
    {
        $this->setDomainName();
        $this->setHostname();
        $this->setProtocol();
        $this->setBaseUrl();
    }

    /**
     * Parses the $_SERVER variable and sets the $domain_name property
     *
     * The desired value differs between Nginx and Apache implementations. This accomodates
     * those differences. This alsow
     *
     * @see Hostname::$domain_name Hostname::$domain_name
     */
    protected function setDomainName()
    {
        $SERVER_SOFTWARE = $_SERVER['SERVER_SOFTWARE'];

        if (strpos($SERVER_SOFTWARE, 'nginx') !== false) {
            $this->domain_name = $_SERVER['HTTP_HOST'];
        } else {
            $this->domain_name = $_SERVER['SERVER_NAME'];
        }

    }

    /**
     * Parses the $domain_name property and sets the Hostname::$hostname property.
     *
     * @see Hostname::$hostname Hostname::$hostname
     */
    protected function setHostname()
    {
        $this->hostname = $this->domain_name;

        $domain_parts = explode('.', $this->hostname);

        if (count($domain_parts) > 2) {
            $this->type = 'subdomain';
            $this->hostname = $domain_parts[0];
        }
    }

    /**
     * Sets the $protocol property
     *
     * Parses the $_SERVER variable and determines if HTTPS is used.
     * Since $protocol is by default HTTPS, overrides to HTTP if necessary.
     *
     * @see  $_SERVER
     * @see  Hostname::$protocol Hostname::$protocol
     */
    protected function setProtocol()
    {
        if (empty($_SERVER['HTTPS']))
            $this->protocol = 'http';
    }

    /**
     * Sets the $base_url property
     *
     * Takes the previously set $protocol and $domain_name properties and constructs
     * the base_url.
     *
     * @see  Hostname::$base_url Hostname::$base_url
     */
    protected function setBaseUrl()
    {
        $this->base_url = $this->protocol . '://' . $this->domain_name;
    }
}