<?php

namespace App\Test\Controller;

use App\Entity\TypeOfMeal;
use App\Repository\TypeOfMealRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TypeOfMealControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private TypeOfMealRepository $repository;
    private string $path = '/type/of/meal/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(TypeOfMeal::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('TypeOfMeal index');

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
            'type_of_meal[description]' => 'Testing',
            'type_of_meal[status]' => 'Testing',
            'type_of_meal[displayOrder]' => 'Testing',
        ]);

        self::assertResponseRedirects('/type/of/meal/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new TypeOfMeal();
        $fixture->setDescription('My Title');
        $fixture->setStatus('My Title');
        $fixture->setDisplayOrder('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('TypeOfMeal');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new TypeOfMeal();
        $fixture->setDescription('My Title');
        $fixture->setStatus('My Title');
        $fixture->setDisplayOrder('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'type_of_meal[description]' => 'Something New',
            'type_of_meal[status]' => 'Something New',
            'type_of_meal[displayOrder]' => 'Something New',
        ]);

        self::assertResponseRedirects('/type/of/meal/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getStatus());
        self::assertSame('Something New', $fixture[0]->getDisplayOrder());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new TypeOfMeal();
        $fixture->setDescription('My Title');
        $fixture->setStatus('My Title');
        $fixture->setDisplayOrder('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/type/of/meal/');
    }
}
