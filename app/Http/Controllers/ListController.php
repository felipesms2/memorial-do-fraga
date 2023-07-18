<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Video;
use Carbon\Carbon;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fileToRead  = __DIR__ . "../../../../resources/video_list.csv";
        $file = fopen($fileToRead,"r");
        $queryId ="";
        // var_dump(fgetcsv($file));
        $count = 0;
        while(! feof($file))
    {

        // dump($count);
        // dump(fgetcsv($file)[1]);
        $queryId .= "&id=" .fgetcsv($file)[1] ;
        $endpoint = "https://www.googleapis.com/youtube/v3/videos?part=id%2C+snippet&" . $queryId .
        "&key=AIzaSyBB93pQFssH3DTGXfROEojYCJARPOzQj04&id=GOuSNVTKfRs"
        ;
        // dump($queryId);
        $count++;
        if ($count==20)
        {
        	$client = new Client();
		$response = $client->get($endpoint);

		$data = json_decode($response->getBody(),
		false);

/*
echo "<pre>";
var_dump($data);
echo "</pre> <br> <hr>";
*/
// dd($data->items);
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

    return $insertVideo;

}
dump($data->items);
echo "<pre>";
  print_r($titles);
echo "</pre>";

            die;
        }

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
        die;
        return ".." . __DIR__;
        return [1,2,3];
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
