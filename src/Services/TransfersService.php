<?php

declare(strict_types=1);

namespace Bila\Services;

use Bila\Client;
use Bila\Core\Exceptions\APIException;
use Bila\Core\Util;
use Bila\RequestOptions;
use Bila\ServiceContracts\TransfersContract;
use Bila\Transfers\TransferGetResponse;
use Bila\Transfers\TransferGetStatusByReferenceResponse;
use Bila\Transfers\TransferInitiateBankTransferParams\Country;
use Bila\Transfers\TransferInitiateBankTransferResponse;
use Bila\Transfers\TransferInitiateMobileMoneyTransferParams\Operator;
use Bila\Transfers\TransferInitiateMobileMoneyTransferResponse;
use Bila\Transfers\TransferListParams\Status;
use Bila\Transfers\TransferListParams\Type;
use Bila\Transfers\TransferListResponse;

/**
 * Payout/transfer operation endpoints.
 *
 * @phpstan-import-type RequestOpts from \Bila\RequestOptions
 */
final class TransfersService implements TransfersContract
{
    /**
     * @api
     */
    public TransfersRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new TransfersRawService($client);
    }

    /**
     * @api
     *
     * Retrieve a single transfer by its UUID
     *
     * @param string $id Transfer UUID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): TransferGetResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a paginated list of transfers/payouts for the authenticated merchant
     *
     * @param string $accountID Filter by account ID
     * @param string $endDate Filter by end date (ISO 8601)
     * @param float $page Page number (default: 1)
     * @param float $perPage Items per page (default: 50)
     * @param string $startDate Filter by start date (ISO 8601)
     * @param Status|value-of<Status> $status Filter by transfer status
     * @param Type|value-of<Type> $type Filter by transfer type
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $accountID = null,
        ?string $endDate = null,
        ?float $page = null,
        ?float $perPage = null,
        ?string $startDate = null,
        Status|string|null $status = null,
        Type|string|null $type = null,
        RequestOptions|array|null $requestOptions = null,
    ): TransferListResponse {
        $params = Util::removeNulls(
            [
                'accountID' => $accountID,
                'endDate' => $endDate,
                'page' => $page,
                'perPage' => $perPage,
                'startDate' => $startDate,
                'status' => $status,
                'type' => $type,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve transfer status by client reference
     *
     * @param string $reference Client reference
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getStatusByReference(
        string $reference,
        RequestOptions|array|null $requestOptions = null
    ): TransferGetStatusByReferenceResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getStatusByReference($reference, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Initiate a transfer to a bank account. Creates a transaction record in your dashboard.
     *
     * @param string $accountID Source account UUID
     * @param float $amount Transfer amount
     * @param string $reference Unique client reference (alphanumeric, dots, underscores, hyphens)
     * @param string $accountNumber Bank account number (required if no transferRecipientId)
     * @param string $bankID Bank ID (required if no transferRecipientId)
     * @param Country|value-of<Country> $country Country code
     * @param string $narration Transfer narration
     * @param string $recipientName Recipient name for the transaction record
     * @param string $transferRecipientID Transfer recipient UUID (use this OR accountNumber+bankId)
     * @param string $walletID Source wallet ID to debit (optional, uses main wallet if not specified)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function initiateBankTransfer(
        string $accountID,
        float $amount,
        string $reference,
        ?string $accountNumber = null,
        ?string $bankID = null,
        Country|string|null $country = null,
        ?string $narration = null,
        ?string $recipientName = null,
        ?string $transferRecipientID = null,
        ?string $walletID = null,
        RequestOptions|array|null $requestOptions = null,
    ): TransferInitiateBankTransferResponse {
        $params = Util::removeNulls(
            [
                'accountID' => $accountID,
                'amount' => $amount,
                'reference' => $reference,
                'accountNumber' => $accountNumber,
                'bankID' => $bankID,
                'country' => $country,
                'narration' => $narration,
                'recipientName' => $recipientName,
                'transferRecipientID' => $transferRecipientID,
                'walletID' => $walletID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->initiateBankTransfer(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Initiate a transfer to a mobile money account. Creates a transaction record in your dashboard.
     *
     * @param float $amount Transfer amount
     * @param \Bila\Transfers\TransferInitiateMobileMoneyTransferParams\Country|value-of<\Bila\Transfers\TransferInitiateMobileMoneyTransferParams\Country> $country Country code
     * @param Operator|value-of<Operator> $operator Mobile money operator
     * @param string $phone Recipient phone number
     * @param string $reference Unique client reference
     * @param string $narration Transfer narration
     * @param string $recipientName Recipient name for the transaction record
     * @param string $walletID Source wallet ID to debit (defaults to main wallet if omitted)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function initiateMobileMoneyTransfer(
        float $amount,
        \Bila\Transfers\TransferInitiateMobileMoneyTransferParams\Country|string $country,
        Operator|string $operator,
        string $phone,
        string $reference,
        ?string $narration = null,
        ?string $recipientName = null,
        ?string $walletID = null,
        RequestOptions|array|null $requestOptions = null,
    ): TransferInitiateMobileMoneyTransferResponse {
        $params = Util::removeNulls(
            [
                'amount' => $amount,
                'country' => $country,
                'operator' => $operator,
                'phone' => $phone,
                'reference' => $reference,
                'narration' => $narration,
                'recipientName' => $recipientName,
                'walletID' => $walletID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->initiateMobileMoneyTransfer(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
