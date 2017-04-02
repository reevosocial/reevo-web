
Elggman is an elgg plugin for bridging mailing lists and group forums.

### 1. Dns configuration.
Create and configure a subdomain for your mailing lists.

You can use your main domain, but it isn't recomended becasue all aliases will go to network groups.

### 2. Copy this plugin to your elgg mod/ folder

### 3. Activate this plugin
Open ***{your_network}**/admin/plugins* in your browser and activate Elggman plugin.

Activate Group Alias too, because it is a dependency.

### 4. Configure this plugin
Open ***{your_network]**/admin/plugin_settings/elggman* and set your mail dns name. Also take note of your mail server api key for later.

### 5. Configure postfix
 Modify the following postfix configuration files:

#### /etc/postfix/main.cf:
add the following to the end of your main.cf file and modify the parts in bold
<pre># our relay domains
relay_domains = <b>groups.n-1.cc</b>
relay_transport = elgg
relayhost =
mynetworks = 127.0.0.0/8 [::ffff:127.0.0.0]/104 [::1]/128 <b>94.23.193.41</b>
transport_maps = hash:/etc/postfix/transport
elgg_destination_recipient_limit = 1</pre>
#### /etc/postfix/master.cf:
add the following line at the end of your master.cf file

<pre>elgg   unix  -       n       n       -       -       pipe  flags=FDX user=www-data argv=<b>/srv/elgg/mod/elggman/deliver.php</b> ${size} ${user} ${sender} <b>http://net.example.org/</b> <b>api_key</b></pre>

Replace the following parts by your values:

* **deliver**: Route to deliver script. Usually in {elgg_path}/mod/elggman/deliver.php
* **network**: Url to reach your network, like https://n-1.cc/
* **api_key**: Secret key you need to get from your elgg install

#### /etc/postfix/transport:
add your domain to the transport list by adding a line like the following to your transport file (modify the parts in bold):

<pre><b>groups.n-1.cc</b> elgg:</pre>

Afterwards execute postmap /etc/postfix/transport to apply the changes.

Finally, restart postfix.

----
devel@lorea.org