import scrapetube

videos = scrapetube.get_channel("UCib793mnUOhWymCh2VJKplQ")

file = open('output.txt', 'w')
for video in videos:
    print(video['videoId'])
    file.write(str(video['videoId']) + '\n')
file.close()
