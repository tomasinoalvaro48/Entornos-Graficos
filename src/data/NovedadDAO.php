<?php

class NovedadDAO extends DBFunctions
{
  
  protected function sanitizeNovedad($novedadFetchArray) 
  {
    $n = null;  
    if($novedadFetchArray)
      $n = new Novedad(
        $novedadFetchArray[''],
        $novedadFetchArray[''],
        $novedadFetchArray[''],
        $novedadFetchArray[''],
        $novedadFetchArray[''],
    );
    return $n;
  }



}
