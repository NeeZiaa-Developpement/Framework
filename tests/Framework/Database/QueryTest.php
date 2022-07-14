<?php 
namespace Tests\Framework\Database;

use NeeZiaa\Database\QueryBuilder;
use PHPUnit\Framework\TestCase;

class QueryTest extends TestCase {

    public function testSimpleQuery() {
        $query = (new \NeeZiaa\Database\QueryBuilder())->table('posts')->select('name');
        $this->assertEquals('SELECT name FROM posts', (string)$query);
    }

    public function testWithWhere() {
        $query = (new \NeeZiaa\Database\QueryBuilder())
            ->table('posts', 'p')
            ->where('a = :a OR b = :b', 'c = :c');
        $this->assertEquals('SELECT * FROM posts as p WHERE (a = :a OR b = :b) AND (c = :c)', $query);
    }

}