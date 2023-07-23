<?php

namespace App\Traits;

trait AdditionalVideoDataTrait
    {
        public function prepareThumb($thumbData, $video_id = 0)
        {
            $thumbToInsert =[];
            $thumbData = (array)$thumbData;
            $bunchThumbLabel = array_keys($thumbData);
            foreach ($bunchThumbLabel as $r)
            {
                $thumbDataConverted =(array)$thumbData[$r];
                $thumbDataConverted['title_thumb'] = $r;
                $thumbDataConverted['video_id'] = $video_id;
                $thumbToInsert[] = $thumbDataConverted;
            }
            return ($thumbToInsert);
        }
    }

