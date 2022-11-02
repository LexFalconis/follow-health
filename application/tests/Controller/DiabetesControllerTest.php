<?php

namespace App\Test\Controller;

use App\Entity\Diabetes;
use App\Repository\DiabetesRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DiabetesControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private DiabetesRepository $repository;
    private string $path = '/diabetes/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Diabetes::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Diabetes index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'diabetes[MeasurementDate]' => 'Testing',
            'diabetes[BloodGlucose]' => 'Testing',
            'diabetes[MeasurementRangeHour]' => 'Testing',
            'diabetes[MeasurementRangeMinute]' => 'Testing',
            'diabetes[Note]' => 'Testing',
        ]);

        self::assertResponseRedirects('/diabetes/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Diabetes();
        $fixture->setMeasurementDate('My Title');
        $fixture->setBloodGlucose('My Title');
        $fixture->setMeasurementRangeHour('My Title');
        $fixture->setMeasurementRangeMinute('My Title');
        $fixture->setNote('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Diabetes');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Diabetes();
        $fixture->setMeasurementDate('My Title');
        $fixture->setBloodGlucose('My Title');
        $fixture->setMeasurementRangeHour('My Title');
        $fixture->setMeasurementRangeMinute('My Title');
        $fixture->setNote('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'diabetes[MeasurementDate]' => 'Something New',
            'diabetes[BloodGlucose]' => 'Something New',
            'diabetes[MeasurementRangeHour]' => 'Something New',
            'diabetes[MeasurementRangeMinute]' => 'Something New',
            'diabetes[Note]' => 'Something New',
        ]);

        self::assertResponseRedirects('/diabetes/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getMeasurementDate());
        self::assertSame('Something New', $fixture[0]->getBloodGlucose());
        self::assertSame('Something New', $fixture[0]->getMeasurementRangeHour());
        self::assertSame('Something New', $fixture[0]->getMeasurementRangeMinute());
        self::assertSame('Something New', $fixture[0]->getNote());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Diabetes();
        $fixture->setMeasurementDate('My Title');
        $fixture->setBloodGlucose('My Title');
        $fixture->setMeasurementRangeHour('My Title');
        $fixture->setMeasurementRangeMinute('My Title');
        $fixture->setNote('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/diabetes/');
    }
}
