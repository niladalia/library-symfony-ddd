<?php

declare(strict_types=1);

namespace App\Tests\Behat;

use App\Tests\src\Shared\Infrastructure\Doctrine\MysqlTestDatabaseCleaner;
use Behat\Gherkin\Node\PyStringNode;
use Doctrine\ORM\EntityManagerInterface;
use Behat\MinkExtension\Context\RawMinkContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use RuntimeException;

class ApiContext extends RawMinkContext
{
    /** @var KernelInterface */
    private $kernel;

    /** @var Response|null */
    private $response;

    public function __construct(KernelInterface $kernel, private EntityManagerInterface $em)
    {
        $this->kernel = $kernel;
        $this->clearDatabase();
    }


    protected function clearDatabase(): void
    {
        $cleaner = new MysqlTestDatabaseCleaner(
            $this->em->getConnection()
        );
        $cleaner->__invoke();
    }

    /**
     * @Given I send a :method request to :url
     */
    public function iSendARequestTo(string $method, string $url): void
    {
        $this->response = $this->kernel->handle(Request::create($url, $method));
    }

    /**
     * @Given I send a :method request to :url with body:
     */
    public function iSendARequestToWithBody(string $method, string $url, PyStringNode $body): void
    {
        $this->response = $this->kernel->handle(
            Request::create(
                $url,
                $method,
                [],
                [],
                [],
                ['HTTP_ACCEPT' => 'application/json', 'CONTENT_TYPE' => 'application/json'],
                $body->getRaw()
            )
        );
    }

    /**
     * @Then the response status code should be :expectedResponseCode
     */
    public function theResponseStatusCodeShouldBe(mixed $expectedResponseCode): void
    {
        if ($this->response->getStatusCode() !== (int) $expectedResponseCode) {
            throw new RuntimeException(
                sprintf(
                    'The status code <%s> does not match the expected <%s>',
                    $this->response->getStatusCode(),
                    $expectedResponseCode
                )
            );
        }
    }

    /**
     * @Then the response should be empty
     */
    public function theResponseShouldBeEmpty(): void
    {
        $actual = trim($this->response->getContent());

        if (!empty($actual)) {
            throw new RuntimeException(sprintf("The outputs is not empty, Actual:\n%s", $actual));
        }
    }

    /**
     * @Then the response content should be:
     */
    public function theResponseContentShouldBe(PyStringNode $expectedResponse): void
    {
        $expected = $this->sanitizeOutput($expectedResponse->getRaw());
        $actual = $this->sanitizeOutput($this->response->getContent());

        if ($expected === false || $actual === false) {
            throw new RuntimeException('The outputs could not be parsed as JSON');
        }

        if ($expected !== $actual) {
            throw new RuntimeException(
                sprintf("The outputs does not match!\n\n-- Expected:\n%s\n\n-- Actual:\n%s", $expected, $actual)
            );
        }
    }

    private function sanitizeOutput(string $output): false|string
    {
        return json_encode(json_decode(trim($output), true, 512, JSON_THROW_ON_ERROR), JSON_THROW_ON_ERROR);
    }

    /**
     * @Then the response should be received
     */
    public function theResponseShouldBeReceived(): void
    {
        if ($this->response === null) {
            throw new \RuntimeException('No response received');
        }
    }
}
