<?php

namespace Tests\Unit;

use App\Services\Determine\Context\ApplicationReader;
use PHPUnit\Framework\TestCase;

class ApplicationReaderTest extends TestCase
{
    /**
     * @var ApplicationReader
     */
    private $applicationReader;

    /** @test */
    public function get_applications ()
    {
        $applicationPaths = $this->applicationReader->getApplications();
        $this->assertEquals(['but', 'dasco', 'maisonsdumonde', 'valeo'], $applicationPaths);
    }

    /** @test */
    public function get_informations_by_application ()
    {
        $informationsByApplication = $this->applicationReader->getInformationsByApplication();
        foreach ($informationsByApplication as $application => $information) {

            $this->assertSame(realpath('/var/www/larabuild/tests/fixtures/appli/' . $application), $information['path']);
            $applicationInUppercase = strtoupper($application);

            $this->assertSame('CONSTANT_VALUE_' . $applicationInUppercase, $information['constant']['CONSTANT']);

            $this->assertSame(
                ['DbStruct' =>
                     ['FIELD' => ['KEY_' . $applicationInUppercase => 'VALUE_' . $applicationInUppercase]]
                ],
                $information['variables']);
        }
    }

    protected function setUp (): void
    {
        parent::setUp();
        $this->applicationReader = new ApplicationReader(env('APPLICATION_PATH'));
    }
}
