<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221102194858 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE diabetes (id INT AUTO_INCREMENT NOT NULL, measurement_date DATETIME NOT NULL, blood_glucose INT NOT NULL, measurement_range_hour INT NOT NULL, measurement_range_minute INT NOT NULL, note VARCHAR(150) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE food_diary (id INT AUTO_INCREMENT NOT NULL, type_of_meal_id INT DEFAULT NULL, satisfaction_with_food_id INT DEFAULT NULL, user_id INT NOT NULL, date DATE NOT NULL, time_woke_up TIME NOT NULL, meal_time TIME NOT NULL, meal_description VARCHAR(1000) NOT NULL, where_was VARCHAR(100) NOT NULL, with_whom VARCHAR(100) NOT NULL, hunger_level INT NOT NULL, post_meal_satiety_level INT NOT NULL, INDEX IDX_601A280883E04142 (type_of_meal_id), INDEX IDX_601A2808314FDB4A (satisfaction_with_food_id), INDEX IDX_601A2808A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pressure (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, systolic INT NOT NULL, diastolic INT NOT NULL, pulse INT NOT NULL, date DATETIME NOT NULL, INDEX IDX_5FAFA067A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE satisfaction_with_food (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(50) NOT NULL, status INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE teste (id INT AUTO_INCREMENT NOT NULL, a VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_of_meal (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(45) NOT NULL, status TINYINT(1) NOT NULL, display_order INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(100) NOT NULL, status TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE food_diary ADD CONSTRAINT FK_601A280883E04142 FOREIGN KEY (type_of_meal_id) REFERENCES type_of_meal (id)');
        $this->addSql('ALTER TABLE food_diary ADD CONSTRAINT FK_601A2808314FDB4A FOREIGN KEY (satisfaction_with_food_id) REFERENCES satisfaction_with_food (id)');
        $this->addSql('ALTER TABLE food_diary ADD CONSTRAINT FK_601A2808A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE pressure ADD CONSTRAINT FK_5FAFA067A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE food_diary DROP FOREIGN KEY FK_601A280883E04142');
        $this->addSql('ALTER TABLE food_diary DROP FOREIGN KEY FK_601A2808314FDB4A');
        $this->addSql('ALTER TABLE food_diary DROP FOREIGN KEY FK_601A2808A76ED395');
        $this->addSql('ALTER TABLE pressure DROP FOREIGN KEY FK_5FAFA067A76ED395');
        $this->addSql('DROP TABLE diabetes');
        $this->addSql('DROP TABLE food_diary');
        $this->addSql('DROP TABLE pressure');
        $this->addSql('DROP TABLE satisfaction_with_food');
        $this->addSql('DROP TABLE teste');
        $this->addSql('DROP TABLE type_of_meal');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
