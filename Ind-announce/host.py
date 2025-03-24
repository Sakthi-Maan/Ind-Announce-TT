import sys
import os

hn = str(sys.argv[1])

def run():
	cmd = 'sudo sh change_hostname.sh '+hn+'&'
	# print (cmd)
	os.system(cmd)
	
if __name__ == "__main__":
	run()