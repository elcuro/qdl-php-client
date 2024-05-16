<?php

declare(strict_types=1);

namespace Elcuro\QdlPhpClient\Client;

use Psr\Http\Client\ClientExceptionInterface as PsrClientExceptionInterfaceAlias;
use Psr\Http\Client\ClientInterface as HttpClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

use function base64_encode;
use function count;
use function json_decode;
use function json_encode;
use function sprintf;

class Client implements ClientInterface
{
    private const BASE_URL = 'https://qdl.sk/myq-api';

    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly RequestFactoryInterface $requestFactory,
        private readonly StreamFactoryInterface $streamFactory,
        private readonly string $username,
        private readonly string $password,
    ) {
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function sendCreateShipment(array $data): array
    {
        $path = '/shipment/create-shipment';

        return $this->sendRequest('POST', $path, $data);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function sendGetLabel(array $data): array
    {
        $path = '/shipment/get-label';

        return $this->sendRequest('POST', $path, $data);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function sendGetProtocol(array $data): array
    {
        $path = '/shipment/protocol';

        return $this->sendRequest('POST', $path, $data);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function sendOrder(): void
    {
        $path = '/shipment/request-pickup';
        $this->sendRequest('POST', $path, []);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function sendStorno(array $data): array
    {
        $path = '/shipment/storno';

        return $this->sendRequest('POST', $path, $data);
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function sendGetStatusHistory(array $data): array
    {
        $path = '/shipment/status-history';

        return $this->sendRequest('POST', $path, $data);
    }

    /**
     * @return array<array-key, mixed>
     *
     * @throws ClientExceptionInterface
     */
    private function sendRequest(string $method, string $path, array $data = []): array
    {
        $url = self::BASE_URL . $path;
        $request = $this->requestFactory->createRequest($method, $url);

        $request = $request->withHeader('Authorization', $this->createAuthorizationHeader());

        if (0 < count($data)) {
            $json = json_encode($data);
            $request = $request->withBody($this->streamFactory->createStream($json));
        }

        try {
            $response = $this->httpClient->sendRequest($request);
        } catch (PsrClientExceptionInterfaceAlias $exception) {
            throw ClientException::fromException($exception);
        }

        if ($response->getStatusCode() === 200) {
            return json_decode($response->getBody()->getContents(), true);
        }

        if ($response->getStatusCode() >= 400 and $response->getStatusCode() < 500) {
            $body = $response->getBody()->getContents();
            $message = empty($body) ? $response->getReasonPhrase() : $body;

            throw new ClientException($message, $response->getStatusCode());
        }

        throw new ClientException($response->getReasonPhrase(), $response->getStatusCode());
    }

    private function createAuthorizationHeader(): string
    {
        return sprintf(
            'Basic %s',
            base64_encode($this->username . ':' . $this->password),
        );
    }
}
