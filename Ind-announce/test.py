#!/usr/bin/env python
from pydub import AudioSegment
from pydub.playback import play

print("hi")
song = AudioSegment.from_mp3("/home/pi/truckdisplayvoice/tamil/english/bell.mp3")
print('playing sound using  pydub')
play(song)

song = AudioSegment.from_mp3("/home/pi/truckdisplayvoice/tamil/english/attntruc.mp3")
print('playing sound using  pydub')
play(song)


#playsound("/home/pi/truckdisplayvoice/tamil/english/bell.mp3")