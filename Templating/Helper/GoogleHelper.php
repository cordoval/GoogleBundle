<?php

/*
 * This file is part of the BITGoogleBundle package.
 *
 * (c) bitgandtter <http://bitgandtter.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BIT\GoogleBundle\Templating\Helper;
use Symfony\Component\Templating\Helper\Helper;
use Symfony\Component\Templating\EngineInterface;
use Google_Client;

class GoogleHelper extends Helper
{
  protected $templating;
  protected $google;
  
  public function __construct( EngineInterface $templating, Google_Client $google )
  {
    $this->templating = $templating;
    $this->google = $google;
  }
  
  public function loginButton( )
  {
    return $this->templating->render( "BITGoogleBundle::loginButton.html.twig" );
  }
  
  public function loginUrl( )
  {
    return $this->google->createAuthUrl( );
  }
  
  public function getName( )
  {
    return 'google';
  }
}
