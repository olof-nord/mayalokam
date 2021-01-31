# mayalokam

Mayalokam is, or more correctly was, a project to allow people to upload music they wanted to listen to using a website.

This project was created in [2011](https://github.com/olof-nord/mayalokam/commit/f1803b3cd85cfa4bbca227d9d6d6259f0f6b7d77) and was put to use on many local LAN parties.

The initial setup was ran with a Windows server 2003 with the [XAMPP](https://en.wikipedia.org/wiki/XAMPP) stack.

For easier use, the whole setup is now also dockerized and can be started locally with `docker-compose up`.

<p align="center">
  <kbd>
    <img src="https://github.com/olof-nord/mayalokam/raw/master/screenshot.png" alt="Screenshot of website"/>
  </kbd>
</p>

## Features

* Configurable max number of uploads per IP
* Configurable max file size
* Configurable allowed file extensions

To specify configuration, see [variables.php](data/variables.php).

## Addresses

To access the file upload page

http://localhost/

To access the php-myadmin DB admin page (see docker-compose file for credentials)

http://localhost:8080/
