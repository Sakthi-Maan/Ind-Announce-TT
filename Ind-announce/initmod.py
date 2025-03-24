#!/usr/bin/env python
# -*- coding: utf-8 -*-
import RPi.GPIO as GPIO
from threading import Thread
import time
import string
import os
import sys
from PIL import Image
from PIL import ImageFont
from PIL import ImageDraw
import numpy as np
import httplib2
import json

from pymodbus.constants import Endian
from pymodbus.payload import BinaryPayloadDecoder
from pymodbus.payload import BinaryPayloadBuilder
from pymodbus.client.sync import ModbusTcpClient as ModbusClient
from pymodbus.compat import iteritems 
from collections import OrderedDict
from subprocess import check_output

ipaddr=str(os.popen("ip -4 addr show eth0 | grep -oP '(?<=inet\s)\d+(\.\d+){3}'").read())
# ipaddr=ipadd[0].strip()

url = 'http://localhost/eventread.php'
resp, content = httplib2.Http().request(url)
eventread = json.loads(content)

url = 'http://localhost/paramread.php'
resp, content = httplib2.Http().request(url)
paramread = json.loads(content)

UNIT = 0x01

def pmodwrite():
    
    global LNO, LE, TXT, FT, SZ, CL, FL, SC, TP, showlogo,ST, CD, SS, FS,FST, BR, UNIT, eventread, paramread
    
    client = ModbusClient(ipaddr, port=502)
    client.connect()
    
    builder = BinaryPayloadBuilder(byteorder=Endian.Big,
                                   wordorder=Endian.Little)
    builder.add_string(ST)										#State
    payload = builder.to_registers()
    payload = builder.build()
    address = 0  													#Reg Addr
    client.write_registers(address, payload, skip_encode=True, unit=1)
        
    
    # elif Params == 'CL':
    
    builder = BinaryPayloadBuilder(byteorder=Endian.Big,
                                   wordorder=Endian.Little)
    builder.add_string(CD)										#State
    payload = builder.to_registers()
    payload = builder.build()
    address = 1  													#Reg Addr
    client.write_registers(address, payload, skip_encode=True, unit=1)
        
    # elif Params == 'SR':
    # print (Params1)
    builder = BinaryPayloadBuilder(byteorder=Endian.Big,
                                   wordorder=Endian.Little)
    builder.add_string(SS)										#State
    payload = builder.to_registers()
    payload = builder.build()
    address = 2  													#Reg Addr
    client.write_registers(address, payload, skip_encode=True, unit=1)
        
    # elif Params == 'FL':
    # print (Params1)
    builder = BinaryPayloadBuilder(byteorder=Endian.Big,
                                   wordorder=Endian.Little)
    builder.add_string(FS)										#State
    payload = builder.to_registers()
    payload = builder.build()
    address = 3  													#Reg Addr
    client.write_registers(address, payload, skip_encode=True, unit=1)
            
    # elif Params == 'BR':
    # print (Params1)
    builder = BinaryPayloadBuilder(byteorder=Endian.Big,
                                   wordorder=Endian.Little)
    builder.add_string(BR)										#State
    payload = builder.to_registers()
    payload = builder.build()
    address = 4 													#Reg Addr
    client.write_registers(address, payload, skip_encode=True, unit=1)
            
    # elif Params == 'showlogo':
    # print (Params1)
    builder = BinaryPayloadBuilder(byteorder=Endian.Big,
                                   wordorder=Endian.Little)
    builder.add_string(showlogo)										#State
    payload = builder.to_registers()
    payload = builder.build()
    address = 6													#Reg Addr
    client.write_registers(address, payload, skip_encode=True, unit=1)
    
    client.close()
    
    client = ModbusClient(ipaddr, port=502)
    

def lmodwrite():
    
    global LNO, LE, TXT, FT, SZ, CL,showlogo, FL, SC, TP, ST, CD, SS,FST, FS, BR, UNIT, eventread, paramread
    
    X=((LNO-1) * 40)
    
    # print 
    
    client = ModbusClient(ipaddr, port=502)
    client.connect()
    
    if Params == 'ST':
    
    builder = BinaryPayloadBuilder(byteorder=Endian.Big,
                                   wordorder=Endian.Little)
    builder.add_string(LE)										                #LINE ENABLE
    payload = builder.to_registers()
    payload = builder.build()
    address = 100 + X 													        #Reg Addr
    client.write_registers(address, payload, skip_encode=True, unit=1)
    print address    
    
    # elif Params == 'CL':
    builder = BinaryPayloadBuilder(byteorder=Endian.Big,
                                   wordorder=Endian.Little)
    TXT=TXT.ljust(64)
    print len(TXT)
    builder.add_string(TXT)										                #TEXT
    payload = builder.to_registers()
    payload = builder.build()
    address = address + 1  													    #Reg Addr
    client.write_registers(address, payload, skip_encode=True, unit=1)
    print address    
        
    # elif Params == 'SR':
    # print (Params1)
    builder = BinaryPayloadBuilder(byteorder=Endian.Big,
                                   wordorder=Endian.Little)
    builder.add_string(FT)										                #FONT
    payload = builder.to_registers()
    payload = builder.build()
    address = address + 32  													#Reg Addr
    client.write_registers(address, payload, skip_encode=True, unit=1)
    print address    
        
    # elif Params == 'FL':
    # print (Params1)
    builder = BinaryPayloadBuilder(byteorder=Endian.Big,
                                   wordorder=Endian.Little)
    builder.add_string(SZ)										                #SIZE
    payload = builder.to_registers()
    payload = builder.build()
    address = address + 1  													    #Reg Addr
    client.write_registers(address, payload, skip_encode=True, unit=1)
    print address    
            
    # elif Params == 'BR':
    # print (Params1)
    builder = BinaryPayloadBuilder(byteorder=Endian.Big,
                                   wordorder=Endian.Little)
    builder.add_string(CL)										                #COLOUR
    payload = builder.to_registers()
    payload = builder.build()
    address = address + 1  													    #Reg Addr
    client.write_registers(address, payload, skip_encode=True, unit=1)
    print address    
    
    
    
    # print (Params1)
    builder = BinaryPayloadBuilder(byteorder=Endian.Big,
                                   wordorder=Endian.Little)
    builder.add_string(FL)										                #FLASH
    payload = builder.to_registers()
    payload = builder.build()
    address = address + 1  													    #Reg Addr
    client.write_registers(address, payload, skip_encode=True, unit=1)
    print address    
    
 
    
    
    # print (Params1)
    builder = BinaryPayloadBuilder(byteorder=Endian.Big,
                                   wordorder=Endian.Little)
    builder.add_string(SC)										                #FLASH
    payload = builder.to_registers()
    payload = builder.build()
    address = address + 1  													    #Reg Addr
    client.write_registers(address, payload, skip_encode=True, unit=1)
    print address    
    
 
    
    
    # print (Params1)
    builder = BinaryPayloadBuilder(byteorder=Endian.Big,
                                   wordorder=Endian.Little)
    builder.add_string(TP)										                #FLASH
    payload = builder.to_registers()
    payload = builder.build()
    address = address + 1  													    #Reg Addr
    client.write_registers(address, payload, skip_encode=True, unit=1)
    print address    
    
    # print (Params1)
    builder = BinaryPayloadBuilder(byteorder=Endian.Big,
                                   wordorder=Endian.Little)
    builder.add_string(FST)										                #FLASH
    payload = builder.to_registers()
    payload = builder.build()
    address = address + 1  													    #Reg Addr
    client.write_registers(address, payload, skip_encode=True, unit=1)
    print address    
    
    print TXT + "done"
    client.close()
    
    client = ModbusClient(ipaddr, port=502)

 
def datdecoder():
    
    global LNO, LE, TXT, FT, SZ, CL, FL, SC, TP,showlogo, ST, CD, SS, FS, BR, UNIT, eventread,FST, paramread
    
    L = LNO - 1
    print L
    if (int(eventread[L]['show_text'])==1):
        LE  =   'YE'
    else:
        LE  =   'NO'

    TXT=(eventread[L]['Text']).encode("utf-8", "strict")
    # TXT     =   

    if (int(eventread[L]['Font'])==1):
        FT  =   'EU'        
    
    elif (int(eventread[L]['Font'])==2):
        FT  =   "HN"
    elif (int(eventread[L]['Font'])==3):
        FT  =   "TM"
    elif (int(eventread[L]['Font'])==4):
        FT  =   "TL"
    elif (int(eventread[L]['Font'])==5):
        FT  =   "BN"
    elif (int(eventread[L]['Font'])==6):
        FT  =   "GJ"
    elif (int(eventread[L]['Font'])==5):
        FT  =   "KN"
    elif (int(eventread[L]['Font'])==6):
        FT  =   "ML"
    elif (int(eventread[L]['Font'])==5):
        FT  =   "SN"
    else:
        FT  =   "EU"
    
    SZ      =   str(int(eventread[L]['Text_Size'])).zfill(2)

    if (int(eventread[L]['Color'])==1):
        CL = "RE"
    elif (int(eventread[L]['Color'])==2):
        CL = "BL"
    elif (int(eventread[L]['Color'])==3):
        CL = "GR"
    elif (int(eventread[L]['Color'])==4):
        CL = "YE"
    elif (int(eventread[L]['Color'])==5):
        CL = "MA"
    elif (int(eventread[L]['Color'])==6):
        CL = "CY"
    elif (int(eventread[L]['Color'])==7):
        CL = "WH"
    else:
        CL = "GR"

    if (int(eventread[L]['blink'])==1):
        FL = "YE"
    else:
        FL = "NO"
    
    if (int(eventread[L]['scroll'])==1):
        SC = "YE"
    else:
        SC = "NO"
    
    if (int(eventread[L]['Top'])==1):
        TP = "YE"
    else:
        TP = "NO"
        
    if (eventread[L]['FontStyle']=="BD"):
        FST = "BD"
    else:
        FST = "NR"
    
def pardecoder():
    
    global LNO, LE, TXT, FT, SZ, CL, FL, SC, TP, ST,showlogo, CD, SS, FS, FST, BR, UNIT, eventread, paramread
    
    if (int(paramread[0]['showlogo'])==1):
        showlogo  =   'YE'
    else:
        showlogo  =   'NO'
    
	if (int(paramread[0]['ST'])==1):
        ST  =   'YE'
    else:
        ST  =   'NO'
    
    if (int(paramread[0]['CD'])==1):
        CD  =   'YE'
    else:
        CD  =   'NO'
    
    SS      =   str(int(paramread[0]['scroll_speed'])).zfill(2)

    FS      =   str(int(paramread[0]['blink_speed'])).zfill(2)

    BR      =   str(int(paramread[0]['brightness'])).zfill(2)

if __name__ == "__main__":

    LNO = 1
    datdecoder()
    time.sleep(0.1)
    lmodwrite()
    time.sleep(0.1)
    
    print "line 1 done"
    
    LNO = 2
    datdecoder()
    time.sleep(0.1)
    lmodwrite()
    time.sleep(0.1)

    LNO = 3
    datdecoder()
    time.sleep(0.1)
    lmodwrite()
    time.sleep(0.1)

    LNO = 4
    datdecoder()
    time.sleep(0.1)
    lmodwrite()
    client = ModbusClient(ipaddr, port=502)
    # client.connect()

    # address = 5  
    # builder = BinaryPayloadBuilder(byteorder=Endian.Big,
                                   # wordorder=Endian.Little)
    # builder.add_string('LA')										        # State
    # payload = builder.to_registers()
    # payload = builder.build()
                                                                            # Reg Addr
    # client.write_registers(address, payload, skip_encode=True, unit=1)
    # print address    

    # client.close()



    #time.sleep(5)
    
    pardecoder()
    time.sleep(0.1)
    pmodwrite()
    time.sleep(0.1)
    
    client.connect()

    # address = 5  
    # builder = BinaryPayloadBuilder(byteorder=Endian.Big,
                                   # wordorder=Endian.Little)
    # builder.add_string('DC')										        # State
    # payload = builder.to_registers()
    # payload = builder.build()
                                                                            # # Reg Addr
    # client.write_registers(address, payload, skip_encode=True, unit=1)
    # print address    

    client.close()
    
