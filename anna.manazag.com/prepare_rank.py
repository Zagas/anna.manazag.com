#!/usr/bin/python

import MySQLdb

# Open database connection
db = MySQLdb.connect("mysql.tmci.me","tmciproject","3CEWeAXk","socialmon" )

# prepare a cursor object using cursor() method
cursor = db.cursor()

# Prepare SQL query to INSERT a record into the database.
sql = "SELECT id, label FROM rank"

try:
	# Execute the SQL command
	cursor.execute(sql)
	# Fetch all the rows in a list of lists.
	results = cursor.fetchall()
	rank = [];
	for row in results:
		id = row[0]
		label = row[1]
		rank.append({'id' : id, 'label' : label})
except:
	print "Error: unable to fecth data"

# prepare rank_list.php
##rank_list = "rank_list/rank_list.php"
rank_list = "/home/manazag/anna.manazag.com/rank_list/rank_list.php"  ## defined by absolute path
FILE = open(rank_list,"w")
list = []
list.append("<?php\n")
list.append("$data_source = array(\n")
for row in rank:
	id = row['id']
	label = row['label']
	string = "\tarray(\"id\" => \"%s\", \"label\" => \"%s\"),\n" % (id, label)
	list.append(string)
list.append("\t);\n")
list.append("?>\n")
FILE.writelines(list)
FILE.close()

# prepare rank summary file foreach rank
for row in rank:
	id = row['id']
	label = row['label']

##	summary = "rank_list/%s.php" % id
        summary = "/home/manazag/anna.manazag.com/rank_list/%s.php" % id  ## defined by absolute path
	FILE = open(summary,"w")
	list = []
	list.append("<?php\n")
	list.append("$data_source = array(\n")

	print "** %s **" % id
	sql = "SELECT entity_id FROM rank_definition WHERE rank_id = \"%s\"" % id
	cursor.execute(sql)
	results = cursor.fetchall()
	for result in results:
		entity = result[0]
		table = entity+"_fan"
		sql = "SELECT timestamp, fan FROM `%s` WHERE network = \"fb\" ORDER BY timestamp DESC limit 2" % table
		cursor.execute(sql)
		data = cursor.fetchall()
		last_fb_fan = data[0][1]
		previous_fb_fan = data[1][1]
		sql = "SELECT label, fb_url, im_url FROM `entity` WHERE id = \"%s\"" % entity
		cursor.execute(sql)
		data = cursor.fetchone()
		label = data[0]
		fb_url = data[1]
		im_url = data[2]
		string = "\tarray(\"label\" => \"%s\", \"fb_url\" => \"%s\",\"im_url\" => \"%s\", \"last_fb_fan\" => \"%s\", \"previous_fb_fan\" => \"%s\"),\n" % (label, fb_url, im_url, last_fb_fan, previous_fb_fan)
		list.append(string)
	list.append("\t);\n")
	list.append("?>\n")
	FILE.writelines(list)
	FILE.close()
# disconnect from server
db.close()
