Simple Calculator in Nette
=============

This app is an example of implementing [Shunting-yard algorithm](https://en.wikipedia.org/wiki/Shunting-yard_algorithm) in PHP. I'm also providing a simple user interface
based on Nette controls.
All commands below are executable in Bash.

Installation
------------
Clone this repo into your directory.

	$ composer install

Create writable directories `temp/` and `log/`.

	$ chmod -R a+rw temp log
	# if you are using selinux run this
	$ chcon -R -t httpd_sys_content_rw_t temp log
	
Create an empty config.local.neon file

    $ touch app/config/config.local.neon

Using web interface
----------------

Open your project in web browser and you should see calc interface.
	
Running tests
----------------

	$ sh tests.sh
