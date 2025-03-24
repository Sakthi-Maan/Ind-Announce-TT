import sys
import os
import RPi.GPIO as GPIO
from threading import Thread
import time
import string

from PIL import Image
from PIL import ImageFont
from PIL import ImageDraw
import numpy as np
import requests
import json
import time
from pymodbus.constants import Endian
from pymodbus.payload import BinaryPayloadDecoder
from pymodbus.payload import BinaryPayloadBuilder
from pymodbus.client.sync import ModbusTcpClient as ModbusClient
from pymodbus.compat import iteritems
from collections import OrderedDict
from subprocess import check_output

ipaddr=str(os.popen("ip -4 addr show eth0 | grep -oP '(?<=inet\s)\d+(\.\d+){3}'").read())
ipadd=ipaddr.split('\n')
ipaddr=ipadd[0].strip()
comd = int(str(sys.argv[1]))
UNIT = 0x01
def run():
	client = ModbusClient(ipaddr, port=5020)
	client.connect()
	
	if (comd <=100):

		rr = client.read_holding_registers(3, 2, unit=UNIT)
		decoder = BinaryPayloadDecoder.fromRegisters(rr.registers,
													 byteorder=Endian.Big,
													 wordorder=Endian.Little)
		Scrollrate=decoder.decode_string(2)+""
		print(Scrollrate)
		rr = client.read_holding_registers(4, 2, unit=UNIT)
		decoder = BinaryPayloadDecoder.fromRegisters(rr.registers,
													 byteorder=Endian.Big,
													 wordorder=Endian.Little)
		blink=decoder.decode_string(2)+""
		print(blink)
		rr = client.read_holding_registers(5, 2, unit=UNIT)
		decoder = BinaryPayloadDecoder.fromRegisters(rr.registers,
													 byteorder=Endian.Big,
													 wordorder=Endian.Little)
		brightness=decoder.decode_string(2)+""
		print(brightness)
		
		url = 'http://'+(ipaddr.strip())+'/update_settings.php?blink='+blink+'&scroll='+Scrollrate+'&brightness='+brightness
		response = requests.post(url, data='')
		jsondata = str(response.text)
		print(url)
		print(jsondata)
		
	else:
		reged=((int(comd-101)/40)+1)
		
		regid = 100+((reged*40)-39)
		
		# regid=1
		
		rr = client.read_holding_registers(regid, 2, unit=UNIT)
		decoder = BinaryPayloadDecoder.fromRegisters(rr.registers,
											byteorder=Endian.Big,
											wordorder=Endian.Little)
													 
		zonesel=decoder.decode_string(2)+""											#Zone
		
		regid=regid+1
		
		rr = client.read_holding_registers(regid, 64, unit=UNIT)
		decoder = BinaryPayloadDecoder.fromRegisters(rr.registers,
													 byteorder=Endian.Big,
													 wordorder=Endian.Little)

		str_modbus1=decoder.decode_string(64)+""									#Text

		regid=regid+32

		rr = client.read_holding_registers(regid, 2, unit=UNIT)
		decoder = BinaryPayloadDecoder.fromRegisters(rr.registers,
													 byteorder=Endian.Big,
													 wordorder=Endian.Little)

		sel1=decoder.decode_string(2)+""											#Font
		
		if 	 sel1 == 'EN':
			fontsel1 = 0

		elif sel1 == 'EB':
			fontsel1 = 1


		elif sel1 == 'HN':
			fontsel1 = 2


		elif sel1 == 'HB':
			fontsel1 = 3


		elif sel1 == 'RN':
			fontsel1 = 4


		elif sel1 == 'RB':
			fontsel1 = 5

		
		regid=regid+1

		rr = client.read_holding_registers(regid, 2, unit=UNIT)
		decoder = BinaryPayloadDecoder.fromRegisters(rr.registers,
													 byteorder=Endian.Big,
													 wordorder=Endian.Little)
		
		fontsiz1=int(str(decoder.decode_string(2)+""))								#Font Size	

		regid=regid+1
		
		rr = client.read_holding_registers(regid, 2, unit=UNIT)
		decoder = BinaryPayloadDecoder.fromRegisters(rr.registers,
											byteorder=Endian.Big,
											wordorder=Endian.Little)
													 
		colour1=decoder.decode_string(2)+""											#Text Colour
		
		regid=regid+1
		
		rr = client.read_holding_registers(regid, 2, unit=UNIT)
		decoder = BinaryPayloadDecoder.fromRegisters(rr.registers,
											byteorder=Endian.Big,
											wordorder=Endian.Little)
													 
		flashstate1=decoder.decode_string(2)+""										#Flash
		
		regid=regid+1

		rr = client.read_holding_registers(regid, 2, unit=UNIT)
		decoder = BinaryPayloadDecoder.fromRegisters(rr.registers,
											byteorder=Endian.Big,
											wordorder=Endian.Little)
													 
		scrollstate1=decoder.decode_string(2)+""									#Scroll
		
		regid=regid+1

		rr = client.read_holding_registers(regid, 2, unit=UNIT)
		decoder = BinaryPayloadDecoder.fromRegisters(rr.registers,
											byteorder=Endian.Big,
											wordorder=Endian.Little)
													 
		top=decoder.decode_string(2)+""												#Top
		
		regid=regid+3
		
		
		# url = 'http://'+(ipaddr.strip())+'/update_settings.php?blink='+blink+'&scroll='+Scrollrate+'&brightness='+brightness
		
		
		
		url = 'http://'+(ipaddr.strip())+'/update_Text.php?line_no='+str(reged)+'&text='+str_modbus1+'&show_text='+str(zonesel)+'&top='+top+'&text_size='+str(fontsiz1)+'&font='+sel1+'&color='+colour1+'&blink='+flashstate1+'&scroll='+scrollstate1
		response = requests.post(url, data='')
		jsondata = str(response.text)
		print(url)
		print(jsondata)
		print("ID:"+str(reged))
		
		
		
		
	client.close()
if __name__ == "__main__":
	run()