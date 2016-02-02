#!/usr/bin/env python
#
# sub-mailhandler.py - frontend for rdm-mailhandler.rb
# v.1.0.2
#
# This script parses the header of a message until it finds a known email;
# then use that email to look for a subaddress pattern that provides a
# project to rdm-mailhandler.rb
#
# It works by using an email of the form:
# <user+project@example.com>
# Most mail servers will deliver this to <user@example.com>, so the + part
# is used to determine the project. A default ptoject can be specified.
#
#
# Copyright 2010-2011 Thomas Guyot-Sionnest <tguyot@gmail.com>
#
# This program is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <http://www.gnu.org/licenses/>.
#

import sys
import email
from email import parser, message, utils
from optparse import OptionParser
from subprocess import Popen, PIPE

oparser = OptionParser(usage='%prog -h | -e <email> [ -p <project> ] -- <command-line>',
                      description='''The <command-line> portion is the full
rdm-mailhandler.rb command that would normally be executed as the mail
handler. The full path to the executable is required. This command should not
include a project; use the build-in --project argument instead.''')

oparser.add_option('-e', '--email', type='string', dest='email',
                  help='Known email to look for (i.e. redmine recipient)')
oparser.add_option('-p', '--project', type='string', dest='project',
                  help='Default project to pass to rdm-mailhandler.rb if there is no subaddress')

(options, args) = oparser.parse_args()

# Get email and make sure it's not having weird formatting already
if options.email is None: oparser.error('You must provide an email address')

try:
    esplit = options.email.index('@')
except ValueError:
    oparser.error('Not an email address')

# Split out email to use the individual parts here and later:
ename = options.email[:esplit]
edomain = options.email[esplit+1:]
try:
    ename.index('+')
    oparser.error('Email provided contains a subaddress already')
except ValueError:
    pass
try:
    edomain.index('@')
    oparser.error('Duplicate @ in email address')
except ValueError:
    pass

# Read-in the headers...
buf = ''
while True:
    line = sys.stdin.readline()
    buf += line
    if line.strip() == '': break

# parse them...
eo = email.parser.HeaderParser()
msg = eo.parsestr(buf, headersonly=True)

# Fetch all email addresses out of them...
tos = msg.get_all('to', [])
ccs = msg.get_all('cc', [])
delivered_tos = msg.get_all('delivered-to',[])
resent_tos = msg.get_all('resent-to', [])
resent_ccs = msg.get_all('resent-cc', [])
all_recipients = email.utils.getaddresses(tos + ccs + delivered_tos + resent_tos + resent_ccs)

# And look for a matching one
project = None
for n, e in all_recipients:
    split = e.index('@')
    email = e[:split]
    domain = e[split+1:]
    subaddr = None

    # If we have a subaddress, get it.
    try:
        ssplit = email.rindex('+')
        subaddr = email[ssplit+1:]
        email = email[:ssplit]
    except ValueError:
        pass

    # Now check email and subaddress, then break if found
    if email == ename and domain == edomain:
        if subaddr:
            project = subaddr
            break

# Finally, execute the handler and pass it the whole thing
if project:
    projectarg = ['-p', project]
elif options.project:
    projectarg = ['-p', options.project]
else:
    projectarg = []

handler = Popen(args + projectarg, stdin=PIPE, stdout=sys.stdout, stderr=sys.stderr, shell=False)
handler.stdin.write(buf)
for l in sys.stdin:
    handler.stdin.write(l)

handler.stdin.close()
handler.wait()
sys.exit(handler.returncode)

