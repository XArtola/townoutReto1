<p align="center"><img src="public/assets/img/logoPNG.png" width="400"></p>

# ToenOut

Townout is a web application where users can play interactive circuits while doscovering new places. A map with a pointer in the actual position wil be displayed in real time in addition to
a clue of the rough position where the next phase will take place.

There will be different types of challenges in the phases. Overcoming them will be the way to discover the next phases location in order to finish the circuit.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

A database administrator will be needed in order to use the application.

```
MySql, MariaDB, Postgres...
```

In addition laravel framework is needed

### Installing

The steps for the installation are the same as in other project

If there is not .env file provided, copy it

```
cp .env.example .env
```

Generate the key

```
php artisan key:generate
```

Install dependencies

```
composer update
```

## Filling the database

There is a series of seeders prepared to fill the databes with all the information needed.

```
php artisan migrate --seed
```

## Deployment in local machine

For the local deployment use the default command

```
php artisan serve
```

## Built With

* [Laravel](https://laravel.com/docs/6.x) - The web framework used
* [Composer](https://getcomposer.org/doc/) - Dependency Management

## Authors

* **Xabier Artola** - [XArtola](https://github.com/XArtola)
* **Koldo Intxausti** - [koldointxausti](https://github.com/koldointxausti)
* **Nerea Labandera** - [nlabandera](https://github.com/nlabandera)

See also the list of [contributors](https://github.com/XArtola/townoutReto1/graphs/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

* Thanks to all the people that has helped during the development and testing of this project

## Note

* As some of the applications main features use geolocation, during the game. Allowing this permission will be neccesary.
No location or any other data get from the players will be used for any purpose.

* In order to test geolocation features, it is recomended to deploy the project in a server
