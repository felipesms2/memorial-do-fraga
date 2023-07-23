<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Video;
use App\Models\Thumbnail;
use Carbon\Carbon;
use App\Traits\AdditionalVideoDataTrait;
use App\Models\Tag;

class ListController extends Controller
{
    use AdditionalVideoDataTrait;
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $fileToRead  = __DIR__ . "../../../../resources/video_list.csv";
        $file = fopen($fileToRead,"r");
        $bunchID = $this->setBunchId($file);
        $group25 = array_chunk($bunchID, 25);
        foreach ($group25 as $g)
        {
            $endpoint = $this->setVideoQueryString($g);
            $client = new Client();
            $response = $client->get($endpoint);
            $data = json_decode($response->getBody());
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

                $insertVideo = Video::Create(
                    [
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
                    ]
                );

                

            }

        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        echo "ola mundo";
    }
}
