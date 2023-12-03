<?php

namespace App\Traits;

use App\Models\Thumbnail;
use App\Models\Video;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Storage;

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

        public function buildVideoArray($obtainedData)
        {
            $data = $obtainedData;
            foreach ($data->items as $item)
            {
                $sni = $item->snippet;
                $sni->defaultAudioLanguage = "NONE";
                $titles[]= $sni->title;
                $title = $sni->title;
                $channelId = $sni->channelId;
                $kind=$item->kind;
                $etag=$item->etag;
                $video_id=$item->id;
                $publishedAt = Carbon::parse($sni->publishedAt, 'UTC');
                $description = $sni->description;
                $categoryId = $sni->categoryId;
                if(isset($sni->defaultAudioLanguage))
                {
                    $defaultAudioLanguage = $sni->defaultAudioLanguage;
                }
                $liveBroadcastContent = $sni->liveBroadcastContent;
                $arrayToInsert = [
                    "title" => $title,
                    "channelId" => $channelId,
                    "kind" => $kind,
                    "video_id" => $video_id,
                    "etag" => $etag,
                    "publishedAt" => $publishedAt,
                    "description" => $description,
                    "categoryId" => $categoryId,
                    "defaultAudioLanguage" => $defaultAudioLanguage,
                    "liveBroadcastContent" => $liveBroadcastContent,
                ];
                return $arrayToInsert;
            }

        }

        public function downloadThumbs(){
            $thumbs = Thumbnail::all();
            foreach ($thumbs as $t) {
                // Perform actions on each item
                // You can access the item's properties using $item->property
                if (  $t->video_id>=0)
                {
                    echo $t->url . "\n";
                    $client = new Client();
                    $response = $client->get($t->url);
                    $folder = 'tmp/fraga';
                    $fileName = $t->video_id . "_" . $t->title_thumb . '.jpg'; // Replace with the desired file name and extension
                    Storage::put($folder.'/'.$fileName, $response->getBody());
                }
            }
        }

        public function downloadVideo()
        {
            $video = Video::all();
            foreach ($video as $v)
            {
                if ($v->id >0)
                {
                    $urlPrefix ="youtube.com/watch?v=";
                    $urlSufix = $v->video_id;
                    $contentNumber = $v->id;
                    $placeToSave = ( __DIR__ . "../../../storage/app/videos/tmp");
                    shell_exec("
                        cd $placeToSave;
                        pytube " . $urlPrefix . $urlSufix . ";" .
                        "mv *.mp4 ../$contentNumber.mp4"
                    );
                }

                // die("baixou");
                echo $v->id . " - ";
            }
        }

    }

