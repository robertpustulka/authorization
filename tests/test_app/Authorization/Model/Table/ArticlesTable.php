<?php
namespace TestApp\Authorization\Model\Table;

use Authorization\AuthorizationAwareInterface;
use Cake\Authorization\BouncerTrait;
use Cake\ORM\Query;
use Cake\ORM\Table;

class ArticlesTable extends Table implements AuthorizationAwareInterface {

    use BouncerTrait;

    public function findFieldsByPermission(Query $query) {
        if (!$this->can('selectSpecialFields')) {
            return $query->select([
                'field1',
                'field2',
                'field3'
            ]);
        }

        return $query;
    }
}
