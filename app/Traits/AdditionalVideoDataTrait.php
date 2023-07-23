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

        public function setVideoQueryString($unitGroup25)
        {

                $queryId = "";
                foreach ($unitGroup25 as $u)
                {
                    $queryId .= "&id=" . $u ;
                    $endpoint = "https://www.googleapis.com/youtube/v3/videos?part=id%2C+snippet&key=AIzaSyBB93pQFssH3DTGXfROEojYCJARPOzQj04&" . $queryId .
                    "";
                }

             return($endpoint);
        }
        public function setBunchId($csvFile)
        {
            $file = $csvFile;
            $bunchID = [];
            while(! feof($file))
            {
                if( $text =fgetcsv($file))
                {
                    $bunchID[] = $text[1];
                }
            }
            fclose($file);
            return $bunchID;

        }
    }

