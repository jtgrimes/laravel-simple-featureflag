<?php namespace JTGrimes\FeatureFlag;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function boot()
    {
        $this->publishes([__DIR__.'/../config/features.php' => config_path('features.php')]);

        $this->mergeConfigFrom(__DIR__.'/../config/features.php', 'features');
    }

    public function register()
    {
        $this->registerBladeDirectives();
    }

    private function registerBladeDirectives()
    {
        \Blade::directive('ifFeature', function($featureName) {
            return "<?php if(feature({$featureName})) : ?>";
        });

        \Blade::directive('elseFeature', function() {
            return "<?php else: ?>";
        });

        \Blade::directive('endFeature', function() {
            return "<?php endif; ?>";
        });
    }
}
