<?php


namespace App\Service;


use App\Entity\Author;
use App\Entity\Book;
use App\Util\LibraryServiceInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class LibraryService implements LibraryServiceInterface
{

    /**
     * @var HttpClientInterface $client
     */
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client, private SerializerInterface $serializer)
    {
        $this->client = $client->withOptions([
            'base_uri' => 'https://jsonplaceholder.typicode.com/'
        ]);
    }

    public function getUsers()
    {
        $response = $this->client->request('GET', 'users');
        return $this->serializer->deserialize($response->getContent(), Author::class . '[]', 'json');
    }

    public function getBooks()
    {
        $response = $this->client->request('GET', 'posts');
        return $this->serializer->deserialize($response->getContent(), Book::class . '[]', 'json');
    }

    public function getUsersWithBooks()
    {
        $books = $this->getBooks();
        $userBooks = [];
        foreach ($books as $book) {
            $tmp = $userBooks[$book->getUserId()] ?? [];
            if (count($tmp) < 3) {
                $userBooks[$book->getUserId()][] = $book;
            }
        }
        $authors = $this->getUsers();

        foreach ($authors as $key => $author) {
            $author->setBooks($userBooks[$author->getId()] ?? []);
            $authors[$key] = $author;
        }
        return $authors;
    }
}