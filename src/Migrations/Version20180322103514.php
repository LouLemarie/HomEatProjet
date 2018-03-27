<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180322103514 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE recipes_recipes');
        $this->addSql('ALTER TABLE recipes ADD recipes_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recipes ADD CONSTRAINT FK_A369E2B5FDF2B1FA FOREIGN KEY (recipes_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_A369E2B5FDF2B1FA ON recipes (recipes_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE recipes_recipes (recipes_source INT NOT NULL, recipes_target INT NOT NULL, INDEX IDX_C574D7E14484E1A9 (recipes_source), INDEX IDX_C574D7E15D61B126 (recipes_target), PRIMARY KEY(recipes_source, recipes_target)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recipes_recipes ADD CONSTRAINT FK_C574D7E14484E1A9 FOREIGN KEY (recipes_source) REFERENCES recipes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipes_recipes ADD CONSTRAINT FK_C574D7E15D61B126 FOREIGN KEY (recipes_target) REFERENCES recipes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipes DROP FOREIGN KEY FK_A369E2B5FDF2B1FA');
        $this->addSql('DROP INDEX IDX_A369E2B5FDF2B1FA ON recipes');
        $this->addSql('ALTER TABLE recipes DROP recipes_id');
    }
}
