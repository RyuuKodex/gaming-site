<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241211142317 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE age_rating (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', external_id VARCHAR(255) NOT NULL, rating INT NOT NULL, category INT NOT NULL, UNIQUE INDEX UNIQ_C1705B559F75D7B0 (external_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_involved_company (game_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', involved_company_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_F1A834E0E48FD905 (game_id), INDEX IDX_F1A834E057B3F61D (involved_company_id), PRIMARY KEY(game_id, involved_company_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_age_rating (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', game_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', age_rating_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_2FAC9CB8E48FD905 (game_id), INDEX IDX_2FAC9CB857CDC09 (age_rating_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_platform (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', game_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', platform_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_92162FEDE48FD905 (game_id), INDEX IDX_92162FEDFFE6496F (platform_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE involved_company (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', external_id VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, developer TINYINT(1) NOT NULL, publisher TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_CFB9F3FC9F75D7B0 (external_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE platform (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', external_id VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_3952D0CB9F75D7B0 (external_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game_involved_company ADD CONSTRAINT FK_F1A834E0E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_involved_company ADD CONSTRAINT FK_F1A834E057B3F61D FOREIGN KEY (involved_company_id) REFERENCES involved_company (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_age_rating ADD CONSTRAINT FK_2FAC9CB8E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE game_age_rating ADD CONSTRAINT FK_2FAC9CB857CDC09 FOREIGN KEY (age_rating_id) REFERENCES age_rating (id)');
        $this->addSql('ALTER TABLE game_platform ADD CONSTRAINT FK_92162FEDE48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE game_platform ADD CONSTRAINT FK_92162FEDFFE6496F FOREIGN KEY (platform_id) REFERENCES platform (id)');
        $this->addSql('ALTER TABLE game ADD name VARCHAR(255) NOT NULL, ADD aggregated_rating DOUBLE PRECISION DEFAULT NULL, ADD aggregated_rating_count INT DEFAULT NULL, ADD category INT DEFAULT NULL, ADD cover VARCHAR(255) DEFAULT NULL, ADD first_release_date DATETIME DEFAULT NULL, ADD franchise LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', ADD game_modes LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', ADD genres LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', ADD slug VARCHAR(255) DEFAULT NULL, ADD status INT DEFAULT NULL, ADD storyline LONGTEXT DEFAULT NULL, ADD summary LONGTEXT DEFAULT NULL, ADD version_title VARCHAR(255) DEFAULT NULL, CHANGE title external_id VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_232B318C9F75D7B0 ON game (external_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE game_involved_company DROP FOREIGN KEY FK_F1A834E0E48FD905');
        $this->addSql('ALTER TABLE game_involved_company DROP FOREIGN KEY FK_F1A834E057B3F61D');
        $this->addSql('ALTER TABLE game_age_rating DROP FOREIGN KEY FK_2FAC9CB8E48FD905');
        $this->addSql('ALTER TABLE game_age_rating DROP FOREIGN KEY FK_2FAC9CB857CDC09');
        $this->addSql('ALTER TABLE game_platform DROP FOREIGN KEY FK_92162FEDE48FD905');
        $this->addSql('ALTER TABLE game_platform DROP FOREIGN KEY FK_92162FEDFFE6496F');
        $this->addSql('DROP TABLE age_rating');
        $this->addSql('DROP TABLE game_involved_company');
        $this->addSql('DROP TABLE game_age_rating');
        $this->addSql('DROP TABLE game_platform');
        $this->addSql('DROP TABLE involved_company');
        $this->addSql('DROP TABLE platform');
        $this->addSql('DROP INDEX UNIQ_232B318C9F75D7B0 ON game');
        $this->addSql('ALTER TABLE game ADD title VARCHAR(255) NOT NULL, DROP external_id, DROP name, DROP aggregated_rating, DROP aggregated_rating_count, DROP category, DROP cover, DROP first_release_date, DROP franchise, DROP game_modes, DROP genres, DROP slug, DROP status, DROP storyline, DROP summary, DROP version_title');
    }
}
