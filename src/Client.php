<?php

declare(strict_types=1);

namespace Bila;

use Bila\Core\BaseClient;
use Bila\Core\Implementation\StreamingHttpClient;
use Bila\Core\Util;
use Bila\Services\AccountsService;
use Bila\Services\BanksService;
use Bila\Services\CollectionsService;
use Bila\Services\ResolveService;
use Bila\Services\TransactionsService;
use Bila\Services\TransferRecipientsService;
use Bila\Services\TransfersService;
use Bila\Services\WebhooksService;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;

/**
 * @phpstan-import-type NormalizedRequest from \Bila\Core\BaseClient
 * @phpstan-import-type RequestOpts from \Bila\RequestOptions
 */
class Client extends BaseClient
{
    public string $apiKey;

    /**
     * @api
     */
    public AccountsService $accounts;

    /**
     * @api
     */
    public TransferRecipientsService $transferRecipients;

    /**
     * @api
     */
    public TransfersService $transfers;

    /**
     * @api
     */
    public CollectionsService $collections;

    /**
     * @api
     */
    public TransactionsService $transactions;

    /**
     * @api
     */
    public WebhooksService $webhooks;

    /**
     * @api
     */
    public BanksService $banks;

    /**
     * @api
     */
    public ResolveService $resolve;

    /**
     * @param RequestOpts|null $requestOptions
     */
    public function __construct(
        ?string $apiKey = null,
        ?string $baseUrl = null,
        RequestOptions|array|null $requestOptions = null,
    ) {
        $this->apiKey = (string) ($apiKey ?? Util::getenv('BILA_API_KEY'));

        $baseUrl ??= Util::getenv('BILA_BASE_URL') ?: 'https://api.usebila.com';

        $options = RequestOptions::parse(
            RequestOptions::with(
                uriFactory: Psr17FactoryDiscovery::findUriFactory(),
                streamFactory: Psr17FactoryDiscovery::findStreamFactory(),
                requestFactory: Psr17FactoryDiscovery::findRequestFactory(),
                transporter: Psr18ClientDiscovery::find(),
            ),
            $requestOptions,
        );

        if (is_null($options->streamingTransporter)) {
            assert(!is_null($options->transporter));
            $options->streamingTransporter = new StreamingHttpClient($options->transporter);
        }

        /** @var array<string, string|null> $headers */
        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'User-Agent' => sprintf('bila/PHP %s', VERSION),
            'X-Stainless-Lang' => 'php',
            'X-Stainless-Package-Version' => '0.2.1',
            'X-Stainless-Arch' => Util::machtype(),
            'X-Stainless-OS' => Util::ostype(),
            'X-Stainless-Runtime' => php_sapi_name(),
            'X-Stainless-Runtime-Version' => phpversion(),
        ];

        $customHeadersEnv = Util::getenv('BILA_CUSTOM_HEADERS');
        if (null !== $customHeadersEnv) {
            foreach (explode("\n", $customHeadersEnv) as $line) {
                $colon = strpos($line, ':');
                if (false !== $colon) {
                    $headers[trim(substr($line, 0, $colon))] = trim(substr($line, $colon + 1));
                }
            }
        }

        parent::__construct(
            headers: $headers,
            baseUrl: $baseUrl,
            options: $options
        );

        $this->accounts = new AccountsService($this);
        $this->transferRecipients = new TransferRecipientsService($this);
        $this->transfers = new TransfersService($this);
        $this->collections = new CollectionsService($this);
        $this->transactions = new TransactionsService($this);
        $this->webhooks = new WebhooksService($this);
        $this->banks = new BanksService($this);
        $this->resolve = new ResolveService($this);
    }

    /** @return array<string,string> */
    protected function authHeaders(): array
    {
        return $this->apiKey ? ['x-api-key' => $this->apiKey] : [];
    }

    /**
     * @internal
     *
     * @param string|list<string> $path
     * @param array<string,mixed> $query
     * @param array<string,string|int|list<string|int>|null> $headers
     * @param RequestOpts|null $opts
     *
     * @return array{NormalizedRequest, RequestOptions}
     */
    protected function buildRequest(
        string $method,
        string|array $path,
        array $query,
        array $headers,
        mixed $body,
        RequestOptions|array|null $opts,
    ): array {
        return parent::buildRequest(
            method: $method,
            path: $path,
            query: $query,
            headers: [...$this->authHeaders(), ...$headers],
            body: $body,
            opts: $opts,
        );
    }
}
