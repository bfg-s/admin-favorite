<?php

namespace Admin\Extend\AdminFavorite;

use Admin\ExtendProvider;
use Admin\Core\ConfigExtensionProvider;
use Admin\Extend\AdminFavorite\Extension\Config;
use Admin\Extend\AdminFavorite\Extension\Install;
use Admin\Extend\AdminFavorite\Extension\Navigator;
use Admin\Extend\AdminFavorite\Extension\Uninstall;
use Exception;

/**
 * Class ServiceProvider
 * @package Admin\Extend\AdminFavorite
 */
class ServiceProvider extends ExtendProvider
{
    /**
     * Extension ID name
     * @var string
     */
    public static string $name = "bfg/admin-favorite";

    /**
     * Extension call slug
     * @var string
     */
    static string $slug = "bfg_admin_favorite";

    /**
     * Extension description
     * @var string
     */
    public static string $description = "Bfg admin favorite complect";

    /**
     * @var string
     */
    protected string $navigator = Navigator::class;

    /**
     * @var string
     */
    protected string $install = Install::class;

    /**
     * @var string
     */
    protected string $uninstall = Uninstall::class;

    /**
     * @var ConfigExtensionProvider|string
     */
    protected string|ConfigExtensionProvider $config = Config::class;

    /**
     * @return void
     * @throws Exception
     */
    public function boot(): void
    {
        parent::boot();

        $this->loadMigrationsFrom(__DIR__.'/../migrations');
    }
}

