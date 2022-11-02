<?php

namespace App\Test\Controller;

use App\Entity\Pressure;
use App\Repository\PressureRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PressureControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private PressureRepository $repository;
    private string $path = '/pressure/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Pressure::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Pressure index');

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
            'pressure[Systolic]' => 'Testing',
            'pressure[Diastolic]' => 'Testing',
            'pressure[Pulse]' => 'Testing',
            'pressure[date]' => 'Testing',
            'pressure[User]' => 'Testing',
        ]);

        self::assertResponseRedirects('/pressure/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Pressure();
        $fixture->setSystolic('My Title');
        $fixture->setDiastolic('My Title');
        $fixture->setPulse('My Title');
        $fixture->setDate('My Title');
        $fixture->setUser('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Pressure');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Pressure();
        $fixture->setSystolic('My Title');
        $fixture->setDiastolic('My Title');
        $fixture->setPulse('My Title');
        $fixture->setDate('My Title');
        $fixture->setUser('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'pressure[Systolic]' => 'Something New',
            'pressure[Diastolic]' => 'Something New',
            'pressure[Pulse]' => 'Something New',
            'pressure[date]' => 'Something New',
            'pressure[User]' => 'Something New',
        ]);

        self::assertResponseRedirects('/pressure/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getSystolic());
        self::assertSame('Something New', $fixture[0]->getDiastolic());
        self::assertSame('Something New', $fixture[0]->getPulse());
        self::assertSame('Something New', $fixture[0]->getDate());
        self::assertSame('Something New', $fixture[0]->getUser());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Pressure();
        $fixture->setSystolic('My Title');
        $fixture->setDiastolic('My Title');
        $fixture->setPulse('My Title');
        $fixture->setDate('My Title');
        $fixture->setUser('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/pressure/');
    }
}
