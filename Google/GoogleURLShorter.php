<?php

/*
 * This file is part of the BITGoogleBundle package.
 *
 * (c) bitgandtter <http://bitgandtter.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BIT\GoogleBundle\Google;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\Session\Session;
use Google_Client;
use Google_UrlshortenerService;
use Google_Url;

/**
 * Implements Google URl Shorter.
 *
 */
class GoogleURLShorter
{
  private $api;
  
  public function __construct( Google_Client $api )
  {
    $this->api = $api;
  }
  
  public function short( $link )
  {
    $service = new Google_UrlshortenerService( $this->api);
    $url = new Google_Url( );
    $url->longUrl = $link;
    $response = $service->url->insert( $url );
    if ( array_key_exists( 'id', $response ) )
      return $response[ 'id' ];
    return null;
  }
}
