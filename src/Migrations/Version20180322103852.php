<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180322103852 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE recipes DROP FOREIGN KEY FK_A369E2B5FDF2B1FA');
        $this->addSql('DROP INDEX IDX_A369E2B5FDF2B1FA ON recipes');
        $this->addSql('ALTER TABLE recipes CHANGE recipes_id cuisto_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recipes ADD CONSTRAINT FK_A369E2B52D8FD1A FOREIGN KEY (cuisto_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_A369E2B52D8FD1A ON recipes (cuisto_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE recipes DROP FOREIGN KEY FK_A369E2B52D8FD1A');
        $this->addSql('DROP INDEX IDX_A369E2B52D8FD1A ON recipes');
        $this->addSql('ALTER TABLE recipes CHANGE cuisto_id recipes_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recipes ADD CONSTRAINT FK_A369E2B5FDF2B1FA FOREIGN KEY (recipes_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_A369E2B5FDF2B1FA ON recipes (recipes_id)');
    }
}
