<?php

// all tables
$bloggerEntriesTable = rex::getTable('blogger_entries');
$bloggerContentTable = rex::getTable('blogger_content');
$bloggerCategoriesTable = rex::getTable('blogger_categories');
$bloggerTagsTable = rex::getTable('blogger_tags');


// ensure tables
$table = rex_sql_table::get($bloggerEntriesTable);
$table->ensurePrimaryIdColumn();
$table->ensureColumn(new rex_sql_column('category', 'int(11)', false, 1));
$table->ensureColumn(new rex_sql_column('tags', 'text', false, ''));
$table->ensureColumn(new rex_sql_column('status', 'int(11)', false, 0));
$table->ensureColumn(new rex_sql_column('postedBy', 'varchar(255)', false, ''));
$table->ensureColumn(new rex_sql_column('postedAt', 'datetime'));
$table->ensure();


$table = rex_sql_table::get($bloggerContentTable);
$table->ensurePrimaryIdColumn();
$table->ensureColumn(new rex_sql_column('pid', 'int(10) unsigned'));
$table->ensureColumn(new rex_sql_column('clang', 'int(11)', false, 1));
$table->ensureColumn(new rex_sql_column('title', 'varchar(255)', false, ''));
$table->ensureColumn(new rex_sql_column('text', 'text', false, ''));
$table->ensureColumn(new rex_sql_column('preview', 'varchar(1024)', false, ''));
$table->ensureColumn(new rex_sql_column('gallery', 'text', false, ''));
$table->ensure();


$table = rex_sql_table::get($bloggerCategoriesTable);
$table->ensurePrimaryIdColumn();
$table->ensureColumn(new rex_sql_column('name', 'varchar(30)', false, ''));
$table->ensure();


$table = rex_sql_table::get($bloggerTagsTable);
$table->ensurePrimaryIdColumn();
$table->ensureColumn(new rex_sql_column('tag', 'varchar(256)', false, ''));
$table->ensure();


// create default entries
$sql = rex_sql::factory();
$sql->setTable($bloggerCategoriesTable);
$sql->select();

if ($sql->getRows() <= 0) {
  $sql = rex_sql::factory();
  $sql->setTable($bloggerCategoriesTable);
  $sql->setValues([ 'id' => 1, 'name' => 'Default' ]);
  $sql->insert();
}


$sql = rex_sql::factory();
$sql->setTable($bloggerTagsTable);
$sql->select();

if ($sql->getRows() <= 0) {
  $sql = rex_sql::factory();
  $sql->setTable($bloggerTagsTable);
  $sql->setValues([ 'id' => 1, 'tag' => 'Default' ]);
  $sql->insert();
}
