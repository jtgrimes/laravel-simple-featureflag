<?php

namespace JTGrimes\FeatureFlag;

use Illuminate\View\ViewFinderInterface;
use Mockery;

class FeatureFlagTest extends TestCase
{
    public function test_helper_reads_flag_correctly()
    {
        \Config::set('features.test', true);
        $this->assertTrue(feature('test'));

        \Config::set('features.test', false);
        $this->assertFalse(feature('test'));
    }

    public function test_blade_directives()
    {
        $fileFinder = Mockery::mock(ViewFinderInterface::class);
        $fileFinder->shouldReceive('find')->andReturn(__DIR__.'\fixtures\feature.blade.php');
        \Config::set('features.test', true);
        \View::setFinder($fileFinder);
        $output = view('feature')->render();
        $this->assertContains('on', $output);
        $this->assertNotContains('off', $output);

        \Config::set('features.test', false);
        $output = view('feature')->render();
        $this->assertContains('off', $output);
        $this->assertNotContains('on', $output);
    }

    public function test_defaults_to_enabled()
    {
        // don't set the configuration...
        $this->assertTrue(feature('no_such_feature'));
    }
}
