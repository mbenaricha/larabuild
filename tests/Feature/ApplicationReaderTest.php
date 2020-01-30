<?php

namespace Tests\Unit;

use App\Services\Determine\Context\ApplicationReader;
use Psr\SimpleCache\CacheInterface;
use Tests\TestCase;

class ApplicationReaderTest extends TestCase
{
    /**
     * @var ApplicationReader
     */
    private $applicationReader;

    private function makeApplicationReader() {
        $this->applicationReader = app(ApplicationReader::class);
    }

    /** @test */
    public function test_cache()
    {
        $cache = app(CacheInterface::class);
        $this->assertFalse($cache->has(config('determine.application_path')));

        $this->makeApplicationReader(); //Reconstruct ApplicationReader to set cache

        $this->assertIsArray($cache->get(config('determine.application_path')));
    }

    /** @test */
    public function get_applications ()
    {
        $this->makeApplicationReader();

        $applicationPaths = $this->applicationReader->getApplications();
        $this->assertEquals(['but', 'dasco', 'maisonsdumonde', 'valeo'], $applicationPaths);
    }

    /** @test */
    public function get_informations_by_application ()
    {
        $this->makeApplicationReader();

        $informationsByApplication = $this->applicationReader->getInformationsByApplication();
        foreach ($informationsByApplication as $application => $information) {

            $this->assertSame(realpath('/var/www/larabuild/tests/fixtures/appli/' . $application), $information['path']);
            $applicationInUppercase = strtoupper($application);

            $this->assertSame('CONSTANT_VALUE_' . $applicationInUppercase, $information['constants']['CONSTANT']);

            $this->assertSame(
                ['FIELD' => ['KEY_' . $applicationInUppercase => 'VALUE_' . $applicationInUppercase]],
                $information['variables']['DbStruct']);
        }
    }
}
