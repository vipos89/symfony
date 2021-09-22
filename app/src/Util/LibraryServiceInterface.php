<?php


namespace App\Util;


interface LibraryServiceInterface
{
        public function getUsers();
        public function getBooks();
        public function getUsersWithBooks();
}