<?php
namespace App;
interface IPersiste {
    function save();
    function del();
    function find($criterio = null);
    function findById($id);
}