ELGG JSON Importer
==================
This tool allows you to import large quantities of ELGG entities and relationships from JSON files. 

Usage: php import-json.php -i /input-dir/ -h test.pleio.nl -d <default_owner_guid> -s ssl

-i: one JSON file or directory that will be scanned for JSON files
-h: hostname of the (sub)site
-d: default owner guid of entities without owner

Installation
------------
Copy the script into <ELGG_ROOT>/import/ and run from console.


GUID handling
-------------
The importer will keep track of entity GUID's and target GUID's in ELGG to correctly link entities together. Make sure the GUID's in the JSON files are unique across entities.

JSON example
------------
This is an example of a JSON file.

	[
	  { 
	    "type": "user", 
	    "subtype": null,    
	    "metadata": {
	      "guid": 1, 
	      "name": "Example user", 
	      "email": "user@example.com"
	    }
	  }, 
	    "type": "object", 
	    "subtype": "blog",     
	    "metadata": {
	      "guid": 2, 
	      "title": "Title of my blog post", 
	      "content": "Lorum Ipsum"
	    }  
	  {
	    "type": "relationship", 
	    "guid_one": 1,
	    "guid_two": 2,
	    "relationship": "likes"
	  }
	]

ElggUser
--------
The script will check if the user exists by matching the e-mail address. If the user not exists, the user will be created. If the user does exist, the script will use the existing user.

ElggFile
--------
The script also allows importing ELGGFile types by specifying the binary property. Files will automatically be moved from the input folder to the ELGG data folder. Placing the import data on the same storage medium as the ELGG data folder will increase performance significantly.

	[
	  { 
	    "type": "object", 
	    "subtype": "file",     
	    "metadata": {
	      "guid": 3, 
	      "title": "A file",
	      "binary": "data/file.txt"
	    }  
	]