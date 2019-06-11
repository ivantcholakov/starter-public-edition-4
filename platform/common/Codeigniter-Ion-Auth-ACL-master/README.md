# Ion Auth ACL
### A handy access control list plugin for Ion Auth 2
by [Steve Goodwin](https://uk.linkedin.com/pub/steve-goodwin/11/979/91a)

Ben Edmunds did an amazing job at putting together a secure and well documented authentication system called Ion Auth, further to this I required a plugin which would work with this library and provide a full ACL (Access Control List) which add's a full permissions based layer below users groups.

This allows for fine grain control over users where both users and groups can have their own permissions to allow / deny actions against them. This library was inspired by a NetTuts tutorial by Andrew Steenbuck (http://code.tutsplus.com/tutorials/a-better-login-system--net-3461).

## Documentation
Documentation is coming, I just thought i'd get a release out to get some feedback for anyone wanting to use this plugin.

## Installation

First of all you'll need to grab a fresh install of codeigniter (v2.0.2 and above), you'll then need to grab a copy of Ben's Ion Auth and follow the install instructions for that (https://github.com/benedmunds/CodeIgniter-Ion-Auth).

Once you've got Ion Auth successfully integrated and working with your existing project or fresh install of CI then just grab this repo and overlay the files in their respective directories and install the sql/install.php with your favourite database editor.

### CodeIgniter Version 3 Compatibility

CodeIgniter v3 requires the class names to be ucfirst().  In order to support this follow the standard installation procedures and then either rename the following files or create symlinks

	models/ion_auth_acl_model.php         =>   models/Ion_auth_acl_model.php

## Usage

In the package you will find example usage code in the controllers and views
folders.  The example code isn't the most beautiful code you'll ever see but
it'll show you how to use the library and it's nice and generic so it doesn't
require a MY_controller or anything else.

You'll need to first create some permissions and assign them to groups and for user specific permissions you'll need to add those into the users permissions. If your adding these manually to start with then the value in the users / groups permissions tables is 1 for allow and 0 for deny.

## Help

Feel free to send me an email if you have any problems.


Thanks,
-Steve Goodwin
 code@weblogics.com
 @steveg1987
