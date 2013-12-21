# import os, re, fileinput

def fileblock(filename):
    fileblock = """
/**
 * Contains the %s class
 *
 * @category  ProfitPress
 * @package   %s
 * @author    Josh Freeman <jdfreeman@satx.rr.com>
 * @copyright 2013 Help Yourself Today LLC
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   1.0.0
 * @link      http://documentation.profitpress.com
 * @since     File available since Release 1.0.0
 */"""

    classblock = """
/**
 * [Short description]
 *
 * [Long description]
 *
 * @category ProfitPress
 * @package  %s
 * @author   Josh Freeman <jdfreeman@satx.rr.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version  1.0.0
 * @link     http://developer.profitpress.com
 * @since    1.0.0
 */"""

    namespace = ''
    classname = ''

    namespace_regex = '^namespace\s+\\\\?(.*)\;';
    classname_regex = '^\s*?(abstract\s|final\s)?class\s+(\w+)';

    class_starts_with = 'abstract class', 'final class', 'class'

    file = open(filename);

    for line in file.readlines():

        line.strip()

        if line.startswith('namespace'):
            namespace = re.search(namespace_regex, line).groups()[0]

        elif line.startswith(class_starts_with):
            classname = re.search(classname_regex, line).groups()[1]

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

            elif line.startswith(class_starts_with):
                print classblock % namespace

            print line,


rootdir = '.'
exlude_dir = ['tests', 'documentation']
for root, subFolders, files in os.walk(rootdir):
    for name in files:
        path = os.path.join(root, name)
        # print subFolders
        filename, ext = os.path.splitext(path)

        if ext == '.php':
            fileblock(path)
