<?php

namespace App\Test\Controller;

use App\Entity\FoodDiary;
use App\Repository\FoodDiaryRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FoodDiaryControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private FoodDiaryRepository $repository;
    private string $path = '/food/diary/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(FoodDiary::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('FoodDiary index');

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
            'food_diary[date]' => 'Testing',
            'food_diary[TimeWokeUp]' => 'Testing',
            'food_diary[MealTime]' => 'Testing',
            'food_diary[MealDescription]' => 'Testing',
            'food_diary[WhereWas]' => 'Testing',
            'food_diary[WithWhom]' => 'Testing',
            'food_diary[HungerLevel]' => 'Testing',
            'food_diary[PostMealSatietyLevel]' => 'Testing',
            'food_diary[typeOfMeal]' => 'Testing',
            'food_diary[SatisfactionWithFood]' => 'Testing',
            'food_diary[User]' => 'Testing',
        ]);

        self::assertResponseRedirects('/food/diary/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new FoodDiary();
        $fixture->setDate('My Title');
        $fixture->setTimeWokeUp('My Title');
        $fixture->setMealTime('My Title');
        $fixture->setMealDescription('My Title');
        $fixture->setWhereWas('My Title');
        $fixture->setWithWhom('My Title');
        $fixture->setHungerLevel('My Title');
        $fixture->setPostMealSatietyLevel('My Title');
        $fixture->setTypeOfMeal('My Title');
        $fixture->setSatisfactionWithFood('My Title');
        $fixture->setUser('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('FoodDiary');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new FoodDiary();
        $fixture->setDate('My Title');
        $fixture->setTimeWokeUp('My Title');
        $fixture->setMealTime('My Title');
        $fixture->setMealDescription('My Title');
        $fixture->setWhereWas('My Title');
        $fixture->setWithWhom('My Title');
        $fixture->setHungerLevel('My Title');
        $fixture->setPostMealSatietyLevel('My Title');
        $fixture->setTypeOfMeal('My Title');
        $fixture->setSatisfactionWithFood('My Title');
        $fixture->setUser('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'food_diary[date]' => 'Something New',
            'food_diary[TimeWokeUp]' => 'Something New',
            'food_diary[MealTime]' => 'Something New',
            'food_diary[MealDescription]' => 'Something New',
            'food_diary[WhereWas]' => 'Something New',
            'food_diary[WithWhom]' => 'Something New',
            'food_diary[HungerLevel]' => 'Something New',
            'food_diary[PostMealSatietyLevel]' => 'Something New',
            'food_diary[typeOfMeal]' => 'Something New',
            'food_diary[SatisfactionWithFood]' => 'Something New',
            'food_diary[User]' => 'Something New',
        ]);

        self::assertResponseRedirects('/food/diary/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getDate());
        self::assertSame('Something New', $fixture[0]->getTimeWokeUp());
        self::assertSame('Something New', $fixture[0]->getMealTime());
        self::assertSame('Something New', $fixture[0]->getMealDescription());
        self::assertSame('Something New', $fixture[0]->getWhereWas());
        self::assertSame('Something New', $fixture[0]->getWithWhom());
        self::assertSame('Something New', $fixture[0]->getHungerLevel());
        self::assertSame('Something New', $fixture[0]->getPostMealSatietyLevel());
        self::assertSame('Something New', $fixture[0]->getTypeOfMeal());
        self::assertSame('Something New', $fixture[0]->getSatisfactionWithFood());
        self::assertSame('Something New', $fixture[0]->getUser());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new FoodDiary();
        $fixture->setDate('My Title');
        $fixture->setTimeWokeUp('My Title');
        $fixture->setMealTime('My Title');
        $fixture->setMealDescription('My Title');
        $fixture->setWhereWas('My Title');
        $fixture->setWithWhom('My Title');
        $fixture->setHungerLevel('My Title');
        $fixture->setPostMealSatietyLevel('My Title');
        $fixture->setTypeOfMeal('My Title');
        $fixture->setSatisfactionWithFood('My Title');
        $fixture->setUser('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/food/diary/');
    }
}
