<?php

declare(strict_types=1);

namespace Bila\ServiceContracts;

use Bila\Core\Exceptions\APIException;
use Bila\RequestOptions;
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
 * @phpstan-import-type RequestOpts from \Bila\RequestOptions
 */
interface TransfersContract
{
    /**
     * @api
     *
     * @param string $id Transfer UUID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): TransferGetResponse;

    /**
     * @api
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
    ): TransferListResponse;

    /**
     * @api
     *
     * @param string $reference Client reference
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getStatusByReference(
        string $reference,
        RequestOptions|array|null $requestOptions = null
    ): TransferGetStatusByReferenceResponse;

    /**
     * @api
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
    ): TransferInitiateBankTransferResponse;

    /**
     * @api
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
    ): TransferInitiateMobileMoneyTransferResponse;
}
