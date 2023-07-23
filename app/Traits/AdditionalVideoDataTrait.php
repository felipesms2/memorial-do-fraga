<?php

namespace App\Traits;

trait AdditionalVideoDataTrait
    {
        public function prepareThumb($thumbData)
        {
            $thumbToInsert =[];
            $thumbData = (array)$thumbData;
            $bunchThumbLabel = array_keys($thumbData);
            foreach ($bunchThumbLabel as $r)
            {
                $thumbDataConverted =(array)$thumbData[$r];
                dump($r);
                dd($thumbDataConverted);
                dump($r);
            }
            dd("a");
        }
    }

