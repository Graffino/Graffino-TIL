 Graffino TIL - Today I Learned in PHP (Laravel)

> Today I Learned is an open-source project by the team at
> [Graffino](https://graffino.com/) inspired by the Tilex project from
> [Hashrocket](https://hashrocket.com/)

## Installation

If you are creating your own version of the site,
[fork](https://help.github.com/articles/fork-a-repo/) the repository.

Then install the [Laravel
Dependencies](http://https://laravel.com/docs/5.6/installation/installation) as well as
PostgreSQL.

Next, follow these setup steps:

```
$ git clone https://github.com/Graffino/Graffino-TIL til
$ cd til
$ composer install
$ php artisan migrate
$ nohup php artisan queue:work --daemon &
$ yarn watch-poll
$ php artisan serve
```

Now you can visit [`localhost:8000`](http://localhost:8000) from your browser.

To serve the app at a different port, include the `--port` flag
when starting the server:

```
$ php artisan serve --port=8081
```

To set environmental variables, copy the example file:

```
$ cp .env.example .env
```

Then, set your variables and source them:

```
$ source .env
```

### Authentication

Authentication is managed by Socialite and Github. See the
https://github.com/laravel/socialite .To allow users from a domain, set those configurations in your environment:

```
# .env

export GITHUB_CLIENT_ID=your-id
export GITHUB_CLIENT_SECRET=your-secret
export HOSTED_DOMAIN=your-domain.com

```

Once set, visit [`localhost:8000/admin`](localhost:8000/admin) and log
in with an email address from your permitted domain.

Tilex creates a new user on the first authentication, and then finds that sameuser on subsequent authentications.



Graffino TIL is released under the [MIT License](http://www.opensource.org/licenses/MIT). Please see [LICENSE](/LICENSE.md) for more information.
