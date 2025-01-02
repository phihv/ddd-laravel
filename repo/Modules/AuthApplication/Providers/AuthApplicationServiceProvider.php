<?php

namespace Modules\AuthApplication\Providers;

use Illuminate\Support\ServiceProvider;

class AuthApplicationServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'AuthApplication';

    protected string $moduleNameLower = 'authapplication';

    /**
     * Boot the application events.
     */
    public function boot(): void
    {
        $this->registerTranslations();
    }

    /**
     * Register translations.
     */
    public function registerTranslations(): void
    {
        $langPath = resource_path('lang/modules/'.$this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
            $this->loadJsonTranslationsFrom($langPath);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'lang'), $this->moduleNameLower);
            $this->loadJsonTranslationsFrom(module_path($this->moduleName, 'lang'));
        }
    }
}
