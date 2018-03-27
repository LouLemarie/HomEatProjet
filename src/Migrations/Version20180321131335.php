<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180321131335 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, street VARCHAR(150) NOT NULL, zip_code INT NOT NULL, city VARCHAR(150) NOT NULL, comment TEXT NOT NULL, number INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE address_has_user (id INT AUTO_INCREMENT NOT NULL, address_id INT DEFAULT NULL, user_id INT DEFAULT NULL, name VARCHAR(150) NOT NULL, INDEX IDX_2E40F397F5B7AF75 (address_id), INDEX IDX_2E40F397A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories_ingredients (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories_recipes (id INT AUTO_INCREMENT NOT NULL, names_categories_recipes VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredients (id INT AUTO_INCREMENT NOT NULL, names_ingredients VARCHAR(150) NOT NULL, allergenes TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredients_categories_ingredients (ingredients_id INT NOT NULL, categories_ingredients_id INT NOT NULL, INDEX IDX_449D79133EC4DCE (ingredients_id), INDEX IDX_449D7913B213CE5A (categories_ingredients_id), PRIMARY KEY(ingredients_id, categories_ingredients_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, status_id INT DEFAULT NULL, recipes_id INT DEFAULT NULL, user_id INT DEFAULT NULL, price NUMERIC(10, 2) NOT NULL, quantities INT NOT NULL, INDEX IDX_E52FFDEE6BF700BD (status_id), INDEX IDX_E52FFDEEFDF2B1FA (recipes_id), INDEX IDX_E52FFDEEA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders_review (orders_id INT NOT NULL, review_id INT NOT NULL, INDEX IDX_D8D3B817CFFE9AD6 (orders_id), INDEX IDX_D8D3B8173E2E969B (review_id), PRIMARY KEY(orders_id, review_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipes (id INT AUTO_INCREMENT NOT NULL, names_recipes VARCHAR(150) NOT NULL, descriptions_recipes TEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipes_categories_recipes (recipes_id INT NOT NULL, categories_recipes_id INT NOT NULL, INDEX IDX_86D5D8D5FDF2B1FA (recipes_id), INDEX IDX_86D5D8D55C7CF1F2 (categories_recipes_id), PRIMARY KEY(recipes_id, categories_recipes_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipes_ingredients (recipes_id INT NOT NULL, ingredients_id INT NOT NULL, INDEX IDX_761206B0FDF2B1FA (recipes_id), INDEX IDX_761206B03EC4DCE (ingredients_id), PRIMARY KEY(recipes_id, ingredients_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, comments TEXT NOT NULL, notes INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE roles (id INT AUTO_INCREMENT NOT NULL, name_role VARCHAR(150) NOT NULL, description_role TEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, names_status VARCHAR(150) NOT NULL, descriptions_status TEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, roles_id INT DEFAULT NULL, firstname VARCHAR(100) NOT NULL, name VARCHAR(100) NOT NULL, mail VARCHAR(100) NOT NULL, pass VARCHAR(255) NOT NULL, date_inscription DATETIME NOT NULL, last_connexion DATETIME NOT NULL, avatar VARCHAR(255) NOT NULL, INDEX IDX_8D93D64938C751C4 (roles_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_recipes (user_id INT NOT NULL, recipes_id INT NOT NULL, INDEX IDX_FB64FCBFA76ED395 (user_id), INDEX IDX_FB64FCBFFDF2B1FA (recipes_id), PRIMARY KEY(user_id, recipes_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE address_has_user ADD CONSTRAINT FK_2E40F397F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE address_has_user ADD CONSTRAINT FK_2E40F397A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ingredients_categories_ingredients ADD CONSTRAINT FK_449D79133EC4DCE FOREIGN KEY (ingredients_id) REFERENCES ingredients (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredients_categories_ingredients ADD CONSTRAINT FK_449D7913B213CE5A FOREIGN KEY (categories_ingredients_id) REFERENCES categories_ingredients (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE6BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEFDF2B1FA FOREIGN KEY (recipes_id) REFERENCES recipes (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE orders_review ADD CONSTRAINT FK_D8D3B817CFFE9AD6 FOREIGN KEY (orders_id) REFERENCES orders (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE orders_review ADD CONSTRAINT FK_D8D3B8173E2E969B FOREIGN KEY (review_id) REFERENCES review (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipes_categories_recipes ADD CONSTRAINT FK_86D5D8D5FDF2B1FA FOREIGN KEY (recipes_id) REFERENCES recipes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipes_categories_recipes ADD CONSTRAINT FK_86D5D8D55C7CF1F2 FOREIGN KEY (categories_recipes_id) REFERENCES categories_recipes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipes_ingredients ADD CONSTRAINT FK_761206B0FDF2B1FA FOREIGN KEY (recipes_id) REFERENCES recipes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipes_ingredients ADD CONSTRAINT FK_761206B03EC4DCE FOREIGN KEY (ingredients_id) REFERENCES ingredients (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64938C751C4 FOREIGN KEY (roles_id) REFERENCES roles (id)');
        $this->addSql('ALTER TABLE user_recipes ADD CONSTRAINT FK_FB64FCBFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_recipes ADD CONSTRAINT FK_FB64FCBFFDF2B1FA FOREIGN KEY (recipes_id) REFERENCES recipes (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE address_has_user DROP FOREIGN KEY FK_2E40F397F5B7AF75');
        $this->addSql('ALTER TABLE ingredients_categories_ingredients DROP FOREIGN KEY FK_449D7913B213CE5A');
        $this->addSql('ALTER TABLE recipes_categories_recipes DROP FOREIGN KEY FK_86D5D8D55C7CF1F2');
        $this->addSql('ALTER TABLE ingredients_categories_ingredients DROP FOREIGN KEY FK_449D79133EC4DCE');
        $this->addSql('ALTER TABLE recipes_ingredients DROP FOREIGN KEY FK_761206B03EC4DCE');
        $this->addSql('ALTER TABLE orders_review DROP FOREIGN KEY FK_D8D3B817CFFE9AD6');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEEFDF2B1FA');
        $this->addSql('ALTER TABLE recipes_categories_recipes DROP FOREIGN KEY FK_86D5D8D5FDF2B1FA');
        $this->addSql('ALTER TABLE recipes_ingredients DROP FOREIGN KEY FK_761206B0FDF2B1FA');
        $this->addSql('ALTER TABLE user_recipes DROP FOREIGN KEY FK_FB64FCBFFDF2B1FA');
        $this->addSql('ALTER TABLE orders_review DROP FOREIGN KEY FK_D8D3B8173E2E969B');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64938C751C4');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE6BF700BD');
        $this->addSql('ALTER TABLE address_has_user DROP FOREIGN KEY FK_2E40F397A76ED395');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEEA76ED395');
        $this->addSql('ALTER TABLE user_recipes DROP FOREIGN KEY FK_FB64FCBFA76ED395');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE address_has_user');
        $this->addSql('DROP TABLE categories_ingredients');
        $this->addSql('DROP TABLE categories_recipes');
        $this->addSql('DROP TABLE ingredients');
        $this->addSql('DROP TABLE ingredients_categories_ingredients');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE orders_review');
        $this->addSql('DROP TABLE recipes');
        $this->addSql('DROP TABLE recipes_categories_recipes');
        $this->addSql('DROP TABLE recipes_ingredients');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE roles');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_recipes');
    }
}
