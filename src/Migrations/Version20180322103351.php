<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180322103351 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE recipes_recipes (recipes_source INT NOT NULL, recipes_target INT NOT NULL, INDEX IDX_C574D7E14484E1A9 (recipes_source), INDEX IDX_C574D7E15D61B126 (recipes_target), PRIMARY KEY(recipes_source, recipes_target)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recipes_recipes ADD CONSTRAINT FK_C574D7E14484E1A9 FOREIGN KEY (recipes_source) REFERENCES recipes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipes_recipes ADD CONSTRAINT FK_C574D7E15D61B126 FOREIGN KEY (recipes_target) REFERENCES recipes (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE user_recipes');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_recipes (user_id INT NOT NULL, recipes_id INT NOT NULL, INDEX IDX_FB64FCBFA76ED395 (user_id), INDEX IDX_FB64FCBFFDF2B1FA (recipes_id), PRIMARY KEY(user_id, recipes_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_recipes ADD CONSTRAINT FK_FB64FCBFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_recipes ADD CONSTRAINT FK_FB64FCBFFDF2B1FA FOREIGN KEY (recipes_id) REFERENCES recipes (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE recipes_recipes');
    }
}
