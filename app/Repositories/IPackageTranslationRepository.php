<?php
namespace App\Repositories;

interface IPackageTranslationRepository
{
    public function getAll();
    public function getById($data);
    public function getByLocale($locale);
    public function add($data);
    public function update($data);
    public function delete($id);
}