import sys
import os

comd = int(str(sys.argv[1]))
# comd = int(str(sys.argv[2]))


def run():

	if (comd == 1):
		cmd = 'python /home/pi/C1/modbus/IndividualControls/Extras.py 1&'
		print (cmd)
		os.system(cmd)
	elif(comd == 2):
		cmd = 'python /home/pi/C1/modbus/IndividualControls/Extras.py 2&'
		print (cmd)
		os.system(cmd)
	else :
		print ("I'm a bot")
if __name__ == "__main__":
	run()