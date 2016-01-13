<?php
namespace App;
interface IModel {
    function create($object);
    function update($object);
    function delete($object, $notUsed = true);
    function find($criterio = null);
    function findById($id);
}
