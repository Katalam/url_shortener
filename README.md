# URL shortener

To get in contact with php i started the most basic project that comes to my mind.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

The given commands are based on a ssh reachable linux machine.

### Prerequisites

You will need a working apache2 web server.

```
$ sudo apt install apache2
```
For more information check [digitalocean.com](https://www.digitalocean.com/community/tutorials/how-to-install-the-apache-web-server-on-ubuntu-18-04)
So install the dotenv environment we need `composer`. Follow that [tutorial](https://linuxize.com/post/how-to-install-and-use-composer-on-ubuntu-18-04/) to install it.

### Installing

First you need to clone the git
```
$ git clone git@github.com:Katalam/url_shortener.git
```
Now you can install the dependencies with
```
$ composer install
```
Now you need to copy the `.env.example` to a new `.env` and fill it with your data.
```
$ cp .env.example .env
```
We will now take a closer look to the database. To execute the given `.sql` file we need to create the database first.
```
$ mysql -u username -p password
```
to enter the mysql command line.
```
mysql> CREATE DATABASE url_shortener;
mysql> exit
```
We can execute the `.sql` file with
```
$ mysql -u username -p password url_shortener < urls.sql
```
System should work now.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
