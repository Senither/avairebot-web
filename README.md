AvaIre Website
==============

The future website for AvaIre the Discord bot.

## Getting Started

The project uses the [Laravel](https://laravel.com/) for the backend, and [Bulma](https://bulma.io/) and [VueJS](https://vuejs.org/) for the frontend, along with [Laravel Mix](https://laravel-mix.com/) to tie everything together.

To host the project, you first need to install all the PHP and NodeJS components using [Composer](https://getcomposer.org/) for the PHP dependencies, and [NPM](https://www.npmjs.com/get-npm) or [Yarn](https://yarnpkg.com/en/) for the Node dependencies.

    $ composer install
    $ yarn

Next, copy the `.env.example` file and call it `.env`, then fill out the `BOT_XXX_URL` and `DB_XXX` environment properties, then save the new `.env` file, now we need to set an application key.

    $ php artisan key:generate

Now we're ready to migration and seed the database.

    $ php artisan migrate --seed

And lastly, we need to build all of our assets, like CSS and JS, we can do this by running one of the `prod`, `dev` or `watch` commands which can be found in the `package.json` file, using `watch` will put the builder into watch mode, re-building all the assets anytime a file is being changed, which makes the speed of development much faster.

    $ yarn prod

And you're done!

## License

AvaIre Website is open-sourced software licensed under the [GNU Affero General Public License v3.0](https://www.gnu.org/licenses/agpl-3.0.en.html).

---

<p align="center">
  <a href="https://discord.gg/gt2FWER"><img src="https://discordapp.com/api/guilds/284083636368834561/widget.png?style=banner2" alt="Discord server"></a>
  <br>AvaIre support server: https://discord.gg/gt2FWER
</p>

---

<p align="center">
    "Discord", "Discord App", and any associated logos are registered trademarks of Hammer & Chisel, inc.
</p>
