<?php

declare(strict_types=1);

namespace Bila\Services;

use Bila\Banks\BankListResponse;
use Bila\Client;
use Bila\Core\Exceptions\APIException;
use Bila\Core\Util;
use Bila\RequestOptions;
use Bila\ServiceContracts\BanksContract;

/**
 * Bank reference data endpoints.
 *
 * @phpstan-import-type RequestOpts from \Bila\RequestOptions
 */
final class BanksService implements BanksContract
{
    /**
     * @api
     */
    public BanksRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new BanksRawService($client);
    }

    /**
     * @api
     *
     * Retrieve a list of all supported banks and financial institutions
     *
     * @param string $country Filter banks by country code
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $country = null,
        RequestOptions|array|null $requestOptions = null
    ): BankListResponse {
        $params = Util::removeNulls(['country' => $country]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
