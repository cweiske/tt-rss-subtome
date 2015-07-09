********************************
SubToMe plugin for Tiny Tiny RSS
********************************

Allows users to register their `Tiny Tiny RSS`__ instance at `subtome.com`__.
Once done, they can subscribe to feeds with only two clicks.

Screenshots are available on the `introductory blog post`__.

__ https://tt-rss.org/
__ https://www.subtome.com/
__ http://cweiske.de/tagebuch/tt-rss-subtome.htm


=====
Usage
=====
#. Go to Tiny Tiny RSS preferences.

That's it. Your Tiny Tiny RSS instance is registered at subtome.com now.

============
Installation
============
Clone this repository into the ``plugins.local/`` directory of your
TT-RSS folder::

    $ cd /path/to/tt-rss/
    $ cd plugins.local/
    $ git clone git://git.cweiske.de/tt-rss-subtome.git subtome

Then enable the plugin in the preferences.

.. note:: To make it easy for everyone, enable the plugin for all
          users by adding it to the ``PLUGINS`` configuration in
          ``config.php``::

            define('PLUGINS', 'auth_internal, note, subtome');

=====
About
=====
The Tiny Tiny RSS SubToMe plugin was written by `Christian Weiske`__
and is licensed under the AGPLv3 or later.

__ cweiske+subtome@cweiske.de
