<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Video;
use App\Models\Thumbnail;
use Carbon\Carbon;
use App\Traits\AdditionalVideoDataTrait;

class ListController extends Controller
{
    use AdditionalVideoDataTrait;
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $count = 1;
        $fileToRead  = __DIR__ . "../../../../resources/video_list.csv";
        $file = fopen($fileToRead,"r");
        $queryId ="";
        $bunchID = [];

        while(! feof($file))
    {

        if( $text =fgetcsv($file)){
            $bunchID[] = $text[1];
        }

        if (1==25)
        {
        	$client = new Client();
	    	$response = $client->get($endpoint);

		$data = json_decode($response->getBody(),
		false);


$titles = [];
foreach ($data->items as $item)
{
    $sni = $item->snippet;
    // $table->string("title");
    // $table->string("channelId");
    // $table->string("kind");
    // $table->string("etag");
    // $table->string("video_id");
    // $table->dateTime("publishedAt");
    // $table->longText("description");
    // $table->string("categoryId");
    // $table->string("liveBroadcastContent");
    // $table->string("defaultAudioLanguage");

    $title = $sni->title;
    $channelId = $sni->channelId;
    $kind=$item->kind;
    $etag=$item->etag;
    $video_id=$item->id;
    $publishedAt = Carbon::parse($sni->publishedAt, 'UTC');
    $description = $sni->description;
    $categoryId = $sni->categoryId  ;
    $defaultAudioLanguage = $sni->defaultAudioLanguage;
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

    // return $insertVideo;

}

        }

        // dd($bunchID);

    }

    /*
    try {
    $pdo = new PDO('sqlite:../../../database/database.sqlite');
    echo "Conexão efetuada com sucesso.";
} catch (PDOException $e) {
    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
}*/
  // Endpoint
    /*   https://www.googleapis.com/youtube/v3/videos?part=id%2C+snippet&id=fL5cWD84mYw&
        id=XYe94GtMkJQ&
        id=qzq2lJZBtCs&
        id=lHlH94GklAE&
        id=Mc4ByWixwdw&
    key=AIzaSyBB93pQFssH3DTGXfROEojYCJARPOzQj04&id=GOuSNVTKfRs */
fclose($file);
    $group25 = array_chunk($bunchID, 25);
    foreach ($group25 as $g)
        {
            foreach ($g as $u)
            {
                $queryId .= "&id=" . $u ;
                $endpoint = "https://www.googleapis.com/youtube/v3/videos?part=id%2C+snippet&" . $queryId .
                "&key=AIzaSyBB93pQFssH3DTGXfROEojYCJARPOzQj04&id=GOuSNVTKfRs";
            }
            $client = new Client();
            $response = $client->get($endpoint);
            $data = json_decode($response->getBody());
            $titles = [];
foreach ($data->items as $item)
{

    $sni = $item->snippet;
    // $table->string("title");
    // $table->string("channelId");
    // $table->string("kind");
    // $table->string("etag");
    // $table->string("video_id");
    // $table->dateTime("publishedAt");
    // $table->longText("description");
    // $table->string("categoryId");
    // $table->string("liveBroadcastContent");
    // $table->string("defaultAudioLanguage");

    $sni->defaultAudioLanguage = "NONE";
    $titles[]= $sni->title;
    $title = $sni->title;
    $channelId = $sni->channelId;
    $kind=$item->kind;
    $etag=$item->etag;
    $video_id=$item->id;
    $publishedAt = Carbon::parse($sni->publishedAt, 'UTC');
    $description = $sni->description;
    $categoryId = $sni->categoryId  ;
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
    $thumbToInsert =$this->prepareThumb($item->snippet->thumbnails, $insertVideo->id);
    foreach ($thumbToInsert as $tti)
        {
            $thumInserted[] = Thumbnail::create($tti);
        }

        }

        dump($titles);
        $queryId = "";

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
