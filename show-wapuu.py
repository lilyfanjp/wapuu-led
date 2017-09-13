#!/usr/bin/env python
# -*- coding: utf-8 -*-

import urllib
import json
import re
import glob
import commands
import time

api = "http://example.net/wp-json/wapuu/v1/get"
image_dir = "~/wapuu/"
viewer = "~/rpi-rgb-led-matrix/utils/led-image-viewer"
opt = " --led-slowdown-gpio=1 --led-no-hardware-pulse --led-chain=4 -L --led-brightness=50 --led-daemon "
pattern = r"^ *(\d+) .*/led-image-viewer"

def img_number():
	try:
		html = urllib.urlopen( api ).read()
	except:
		return None

	data = json.loads(html)
	return data['id']

def kill_img ():
	id = []
	ps_list = commands.getoutput('ps awx')
	for process in ps_list.split("\n"):
		match = re.match(pattern, process)
		if not match:
			continue
		id.append(match.group(1))
	commands.getstatusoutput( "sudo kill " + " ".join(id) )

prev = None
while True:
	time.sleep(2)
	number = img_number()
	if number is None:
		continue

	files = glob.glob( image_dir + number + "-*.png" )
	if len(files) < 1:
		continue
	
	if files[0] == prev:
		continue
	if prev is not None:
		kill_img()
	commands.getstatusoutput( "sudo " + viewer + opt + files[0] )
	prev = files[0]
	
