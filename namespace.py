
def fileblock(filename):
	fileblock = """
	/**
	 * Contains the %s class
	 *
	 * @author     Josh Freeman <jdfreeman@satx.rr.com>
	 * @package    %s
	 * @copyright  2013 Help Yourself Today LLC
	 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
	 * @version    1.0.0
	 * @since      File available since Release 1.0.0
	 */"""

	namespace = ''
	classname = ''

	file = open(filename);

	for line in file.readlines():

		if line.startswith('namespace'):
			namespace = re.search( '^namespace\s+\\\\?(.*)\;', line).groups()[0]

		elif line.startswith('class'):
			classname = re.search('^class\s+(\w+)', line).groups()[0]
		
		elif namespace != '' and classname != '':
			file.close()
			break
		else:
			continue

	if namespace != '' and classname != '':

		skip_until_namespace = False

		for line in fileinput.input(filename,1):

			if fileinput.lineno() == 2:
				skip_until_namespace = True
				print fileblock % (classname, namespace)

			elif skip_until_namespace == True and line.startswith('namespace'):
				skip_until_namespace = False

			elif skip_until_namespace == True:
				continue

			print line,

import os

rootdir = '.'
for root, subFolders, files in os.walk(rootdir):
    for name in files:
    	path = os.path.join(root, name)
    
    	filename, ext = os.path.splitext(path)

    	if ext == '.php':
    		# fileblock(filename)
    		print path
