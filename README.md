# ArtisanConsoleMakeTraits for Laravel 5.4

1 step:

Save this class into 'app/Console/Commands/'

2 step:

Add to 'app/Console.Kernel.php'

```
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Command\MakeTrait::class,
    ];
```
3 step

Run command:

```
$ php artisan make:trait TestTrait
```
