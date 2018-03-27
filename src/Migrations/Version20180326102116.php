<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180326102116 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE recipes_categories_recipes');
        $this->addSql('ALTER TABLE recipes ADD categories_recipes_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recipes ADD CONSTRAINT FK_A369E2B55C7CF1F2 FOREIGN KEY (categories_recipes_id) REFERENCES categories_recipes (id)');
        $this->addSql('CREATE INDEX IDX_A369E2B55C7CF1F2 ON recipes (categories_recipes_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE recipes_categories_recipes (recipes_id INT NOT NULL, categories_recipes_id INT NOT NULL, INDEX IDX_86D5D8D5FDF2B1FA (recipes_id), INDEX IDX_86D5D8D55C7CF1F2 (categories_recipes_id), PRIMARY KEY(recipes_id, categories_recipes_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recipes_categories_recipes ADD CONSTRAINT FK_86D5D8D55C7CF1F2 FOREIGN KEY (categories_recipes_id) REFERENCES categories_recipes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipes_categories_recipes ADD CONSTRAINT FK_86D5D8D5FDF2B1FA FOREIGN KEY (recipes_id) REFERENCES recipes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipes DROP FOREIGN KEY FK_A369E2B55C7CF1F2');
        $this->addSql('DROP INDEX IDX_A369E2B55C7CF1F2 ON recipes');
        $this->addSql('ALTER TABLE recipes DROP categories_recipes_id');
    }
}
