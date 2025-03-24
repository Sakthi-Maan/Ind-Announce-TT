#!/usr/bin/env python

import sys, getopt
import pygame 
import thread
import threading 
import time 
import json 
import array
import RPi.GPIO as GPIO
import time
import os
import httplib2
from pydub import AudioSegment
from pydub.playback import play
import io
import base64
from curses.ascii import isprint




def main(argv):
    pygame.init()
    pygame.mixer.init()
    inputfile = ''
    outputfile = ''
    

    
    
    
    
    opts, args = getopt.getopt(argv,"ht:d:",["truckno=","dname="])
    for opt, arg in opts:
      if opt == '-h':
         print ('test.py -t <inputfile> -d <outputfile>')
         sys.exit()
      elif opt in ("-t", "--truckno"):
         inputfile = arg
      elif opt in ("-d", "--dname"):
         outputfile = arg
    print ('truckno is ', inputfile)
    print ('dname is ', outputfile)
    
    
    try:
        url = ('http://localhost/get_name_contents.php?dname='+outputfile.replace(" ", "%20"))
        print(url)
        resp, content = httplib2.Http().request(url)
        #print('1')

        paramread = json.loads(content)
        print(paramread)
        rotstat =str(paramread[0]['d_name'])							#rotate status
        rotstat = rotstat.strip()
    except Exception as e:
        print(e)
        rotstat = ""

    d_string2='N'
    Language='english'
    a_string3= inputfile 
    pygame.mixer.music.load("/home/pi/truckdisplayvoice/tamil/"+Language+"/bell.mp3")
    pygame.mixer.music.play()
    while pygame.mixer.music.get_busy() == True:
        time.sleep(.1)
        continue
    pygame.mixer.music.load("/home/pi/truckdisplayvoice/tamil/"+Language+"/attntruc.mp3")
    pygame.mixer.music.play()
    while pygame.mixer.music.get_busy() == True:
        time.sleep(.1)
        continue
    a_string4=a_string3.decode('utf-8').lower()
    for letter in a_string4:
                              
        if ((letter)>'/' and (letter)<':') or ((letter)>'`' and (letter)<'{'):
            pygame.mixer.music.load("/home/pi/truckdisplayvoice/tamil/"+Language+"/"+letter+"_e.mp3")
            pygame.mixer.music.play()
            while pygame.mixer.music.get_busy() == True:
                time.sleep(.1)
                continue
        else:
            time.sleep(.5)
    if rotstat!="":
        song = AudioSegment.from_file(io.BytesIO(base64.b64decode(paramread[0]['audio_content'])), format="mp3")
        play(song)
    if d_string2=="N":
        pygame.mixer.music.load("/home/pi/truckdisplayvoice/tamil/"+Language+"/normal.mp3")
    else:
        pygame.mixer.music.load("/home/pi/truckdisplayvoice/tamil/"+Language+"/timeout.mp3")
        
    #print("1")
    pygame.mixer.music.play()
    while pygame.mixer.music.get_busy() == True:
        time.sleep(.1)
        continue
    time.sleep(1)


if __name__ == "__main__":
   main(sys.argv[1:])