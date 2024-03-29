<?php

declare(strict_types=1);

use Core\Utils\Enums\TypeUniteTravailleEnum;
use Core\Utils\Traits\Database\Migrations\CanDeleteTrait;
use Core\Utils\Traits\Database\Migrations\HasCompositeKey;
use Core\Utils\Traits\Database\Migrations\HasForeignKey;
use Core\Utils\Traits\Database\Migrations\HasTimestampsAndSoftDeletes;
use Core\Utils\Traits\Database\Migrations\HasUuidPrimaryKey;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class ***`CreateUniteTravaillesTable`***
 *
 * A migration class for creating the "unite_travailles" table with UUID primary key and timestamps.
 *
 * @package ***`\Database\Migrations\CreateUniteTravaillesTable`***
 */
class CreateUniteTravaillesTable extends Migration
{
    use CanDeleteTrait, HasCompositeKey, HasForeignKey, HasTimestampsAndSoftDeletes, HasUuidPrimaryKey;
    
    /**
     * Run the migrations.
     * 
     * @return void
     * 
     * @throws \Core\Utils\Exceptions\DatabaseMigrationException If the migration fails.
     */
    public function up(): void
    {
        // Begin the database transaction
        DB::beginTransaction();

        try {

            Schema::create('unite_travailles', function (Blueprint $table) {
                // Define a UUID primary key for the 'unite_travailles' table
                $this->uuidPrimaryKey($table);

                // "type_of_unite_travaille" column with default value "article"
                $table->enum('type_of_unite_travaille', TypeUniteTravailleEnum::values())->default(TypeUniteTravailleEnum::DEFAULT);
                
                // Define a foreign key for 'unite_mesure_id', referencing the 'unite_mesures' table
                $this->foreignKey(
                    table: $table,          // The table where the foreign key is being added
                    column: 'unite_mesure_id',   // The column to which the foreign key is added ('unite_mesure_id' in this case)
                    references: 'unite_mesures',    // The referenced table (unite_mesures) to establish the foreign key relationship
                    onDelete: 'cascade',    // Action to perform when the referenced record is deleted (cascade deletion)
                    nullable: false          // Specify whether the foreign key column can be nullable (false means it not allows to be NULL)
                );

                // Define a foreign key for 'article_id', referencing the 'articles' table
                $this->foreignKey(
                    table: $table,          // The table where the foreign key is being added
                    column: 'article_id',   // The column to which the foreign key is added ('article_id' in this case)
                    references: 'articles',    // The referenced table (articles) to establish the foreign key relationship
                    onDelete: 'cascade',    // Action to perform when the referenced record is deleted (cascade deletion)
                    nullable: true          // Specify whether the foreign key column can be nullable (true means it allows to be NULL)
                );

                // Add a boolean column 'status' to the table
                $table->boolean('status')
                    ->default(TRUE) // Set the default value to TRUE
                    ->comment('Record status: 
                            - TRUE: Active record or soft delete record
                            - FALSE: permanently Deleted and can be archived in another datastore'
                        ); // Describe the meaning of the 'status' column

                // Add a boolean column 'can_be_delete' with default value false
                $this->addCanDeleteColumn(table: $table, column_name: 'can_be_delete', can_be_delete: true);
                
                // Define a foreign key for 'created_by', pointing to the 'users' table
                $this->foreignKey(
                    table: $table,          // The table where the foreign key is being added
                    column: 'created_by',   // The column to which the foreign key is added ('created_by' in this case)
                    references: 'users',    // The referenced table (users) to establish the foreign key relationship
                    onDelete: 'cascade',    // Action to perform when the referenced record is deleted (cascade deletion)
                    nullable: false          // Specify whether the foreign key column can be nullable (false means it not allows NULL)
                );

                // Create a composite index for efficient searching on the combination of type_of_unite_travaille, 'unite_mesure_id', status and can_be_delete
                $this->compositeKeys(table: $table, keys: ['type_of_unite_travaille', 'unite_mesure_id', 'status', 'can_be_delete']);

                // Add timestamp and soft delete columns to the table
                $this->addTimestampsAndSoftDeletesColumns($table);
            });

            // Commit the transaction
            DB::commit();
        } catch (\Throwable $exception) {
            // Rollback the transaction in case of an exception
            DB::rollBack();

            // Handle the exception (e.g., logging, notification, etc.)
            throw new \Core\Utils\Exceptions\DatabaseMigrationException(
                message: 'Failed to migrate "unite_travailles" table: ' . $exception->getMessage(),
                previous: $exception
            );
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     *
     * @throws \Core\Utils\Exceptions\DatabaseMigrationException If the migration fails.
     */
    public function down(): void
    {
        // Begin the database transaction
        DB::beginTransaction();

        try {
            // Drop the "unite_travailles" table if it exists
            Schema::dropIfExists('unite_travailles');

            // Commit the transaction
            DB::commit();
        } catch (\Throwable $exception) {
            // Rollback the transaction in case of an exception
            DB::rollBack();

            // Handle the exception (e.g., logging, notification, etc.)
            throw new \Core\Utils\Exceptions\DatabaseMigrationException(
                message: 'Failed to drop "unite_travailles" table: ' . $exception->getMessage(),
                previous: $exception
            );
        }
    }
}
