<?php

namespace App\Traits;

trait HasInternet
{
      public function ConnectedToInternet() : bool
      {
          $connected = @fsockopen("www.google.com", 80);
          //website, port  (try 80 or 443)
          if ($connected){
              return true;
          }else{
              return false;
          }
      }
}
