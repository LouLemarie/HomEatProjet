<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180322105538 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE orders DROP price');
        $this->addSql('ALTER TABLE recipes ADD price NUMERIC(10, 2) NOT NULL, CHANGE names_recipes titre VARCHAR(150) NOT NULL, CHANGE descriptions_recipes description TEXT NOT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE orders ADD price NUMERIC(10, 2) NOT NULL');
        $this->addSql('ALTER TABLE recipes DROP price, CHANGE titre names_recipes VARCHAR(150) NOT NULL COLLATE utf8_unicode_ci, CHANGE description descriptions_recipes TEXT NOT NULL COLLATE utf8_unicode_ci');
    }
}
